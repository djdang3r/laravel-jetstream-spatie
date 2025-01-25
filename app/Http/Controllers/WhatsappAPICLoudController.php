<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Template;
use App\Models\WhatsappBusinessAccount;
use App\Models\WhatsappPhoneNumber;
use App\Models\WhatsappBusinessProfile;
use App\Models\Website;


class WhatsappAPICLoudController extends Controller
{
    public function whatsappManager()
    {
        return view('whatsapp_manager.index');
    }

    public function templatesList()
    {
        return view('templates.templates');
    }

    public function getTemplates($phone_profile)
    {

        $account = WhatsappBusinessAccount::find($phone_profile->phoneNumber->businessAccount->whatsapp_business_id);

        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        $api_token = $account->api_token;

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener los números de teléfono
            $templates = $this->fetchTemplates($api_token, $account->whatsapp_business_id);

            // Confirmar la transacción
            DB::commit();

            // Devolver la respuesta
            return response()->json($templates);

        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['error' => 'Failed to fetch templates', 'message' => $e->getMessage()], 500);
        }
    }

    public function getPhoneNumbers($whatsapp_business_id)
    {



        $account = WhatsappBusinessAccount::find($whatsapp_business_id);

        if (!$account) {
            Log::error('Account not found', ['whatsapp_business_id' => $whatsapp_business_id]);
            return response()->json(['error' => 'Account not found'], 404);
        }

        $api_token = $account->api_token;

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener los números de teléfono
            $phoneNumbers = $this->fetchPhoneNumbers($api_token, $whatsapp_business_id);

            // Log::info('Phone numbers fetched', ['phoneNumbers' => $phoneNumbers]);

            foreach ($phoneNumbers as $phoneNumber) {
                $cleanedPhoneNumber = preg_replace('/\D/', '', $phoneNumber['display_phone_number']);
                // Log::info('Processing phone number', ['phoneNumber' => $phoneNumber]);

                // Buscar si el número de teléfono ya existe
                $phoneNumberRecord = WhatsappPhoneNumber::where('phone_number_id', $phoneNumber['id'])->first();

                // Obtener el perfil del número de teléfono
                $profileData = $this->fetchPhoneNumberProfile($api_token, $phoneNumber['id']);
                $profileData = $profileData['data'][0];
                // Log::info('Profile data fetched', ['profileData' => $profileData]);

                if ($phoneNumberRecord) {
                    // Actualizar el número de teléfono existente
                    $phoneNumberRecord->update([
                        'display_phone_number' => $cleanedPhoneNumber,
                        'verified_name' => $phoneNumber['verified_name'],
                    ]);
                    // Log::info('Phone number updated', ['phoneNumberRecord' => $phoneNumberRecord]);

                    // Buscar si el perfil ya existe
                    if ($phoneNumberRecord->whatsapp_bussines_profile_id !== null) {
                        $profileRecord = WhatsappBusinessProfile::where('whatsapp_business_profile_id', $phoneNumberRecord->whatsapp_bussines_profile_id)->first();

                        // Actualizar el perfil existente
                        $profileRecord->update([
                            'about' => $profileData['about'] ?? null,
                            'address' => $profileData['address'] ?? null,
                            'description' => $profileData['description'] ?? null,
                            'email' => $profileData['email'] ?? null,
                            'profile_picture_url' => $profileData['profile_picture_url'] ?? null,
                            'vertical' => $profileData['vertical'] ?? null,
                            'messaging_product' => $profileData['messaging_product'] ?? 'whatsapp',
                        ]);
                        // Log::info('Profile updated', ['profileRecord' => $profileRecord]);
                    } else {
                        // Crear un nuevo perfil
                        $profileRecord = WhatsappBusinessProfile::create([
                            'whatsapp_business_profile_id' => $phoneNumber['id'],
                            'about' => $profileData['about'] ?? null,
                            'address' => $profileData['address'] ?? null,
                            'description' => $profileData['description'] ?? null,
                            'email' => $profileData['email'] ?? null,
                            'profile_picture_url' => $profileData['profile_picture_url'] ?? null,
                            'vertical' => $profileData['vertical'] ?? null,
                            'messaging_product' => $profileData['messaging_product'] ?? 'whatsapp',
                        ]);
                        // Log::info('New profile created', ['profileRecord' => $profileRecord]);

                        $phoneNumberRecord->update([
                            'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                        ]);
                    }
                } else {
                    // Crear un nuevo número de teléfono
                    $phoneNumberRecord = WhatsappPhoneNumber::create([
                        'phone_number_id' => $phoneNumber['id'],
                        'whatsapp_business_accounts_id' => $whatsapp_business_id,
                        'display_phone_number' => $cleanedPhoneNumber,
                        'verified_name' => $phoneNumber['verified_name'],
                    ]);
                    // Log::info('New phone number created', ['phoneNumberRecord' => $phoneNumberRecord]);

                    // Crear un nuevo perfil
                    $profileRecord = WhatsappBusinessProfile::create([
                        'whatsapp_business_profile_id' => $phoneNumber['id'],
                        'about' => $profileData['about'] ?? null,
                        'address' => $profileData['address'] ?? null,
                        'description' => $profileData['description'] ?? null,
                        'email' => $profileData['email'] ?? null,
                        'profile_picture_url' => $profileData['profile_picture_url'] ?? null,
                        'vertical' => $profileData['vertical'] ?? null,
                        'messaging_product' => $profileData['messaging_product'] ?? 'whatsapp',
                    ]);
                    // Log::info('New profile created', ['profileRecord' => $profileRecord]);

                    $phoneNumberRecord->update([
                        'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                    ]);
                }

                // Guardar los sitios web
                if (isset($profileData['websites'])) {
                    // Eliminar sitios web existentes
                    Website::where('whatsapp_business_profile_id', $profileRecord->whatsapp_business_profile_id)->delete();
                    // Log::info('Existing websites deleted', ['profileRecord' => $profileRecord]);

                    // Guardar nuevos sitios web
                    foreach ($profileData['websites'] as $website) {
                        // Verificar si el sitio web ya existe
                        $existingWebsite = Website::Where('whatsapp_business_profile_id', $profileRecord->whatsapp_business_profile_id)
                                                  ->where('website', $website)
                                                  ->first();

                        if (!$existingWebsite) {
                            Website::create([
                                'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                                'website' => $website,
                            ]);
                            // Log::info('New website created', ['website' => $website]);
                        } else {
                            // Log::info('Website already exists', ['website' => $website]);
                        }
                    }
                }
            }

            // Confirmar la transacción
            DB::commit();
            // Log::info('Transaction committed');

            // Devolver la respuesta
            return response()->json($phoneNumbers);

        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            Log::error('Failed to fetch phone numbers or profiles', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to fetch phone numbers or profiles', 'message' => $e->getMessage()], 500);
        }
    }

    private function fetchPhoneNumbers($api_token, $whatsapp_business_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');
        $url = "{$api_url}/{$api_version}/{$whatsapp_business_id}/phone_numbers";
        // Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);

        // dd($response->json()['data']);
        if ($response->successful()) {
            return $response->json()['data'];
        } else {
            throw new \Exception("Failed to fetch phone numbers: " . $response->body());
        }
    }

    private function fetchPhoneNumberProfile($api_token, $phone_number_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');

        $url = "{$api_url}/{$api_version}/{$phone_number_id}/whatsapp_business_profile?fields=about,address,description,email,profile_picture_url,websites,vertical";
        // Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);
        // dd($response->json()['data']);
        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception("Failed to fetch phone number profile: " . $response->body());
        }
    }

    private function fetchTemplates($api_token, $whatsapp_business_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');
        $url = "{$api_url}/{$api_version}/{$whatsapp_business_id}/message_templates";

        // Log::info("Fetching templates from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);

        if ($response->status() == 200) {
            $templates = $response->json()['data'];

            foreach ($templates as $templateData) {
                Template::updateOrCreate(
                    ['wa_template_id' => $templateData['id']],
                    [
                        'whatsapp_business_id' => $whatsapp_business_id,
                        'name' => $templateData['name'],
                        'language' => $templateData['language'],
                        'category' => $templateData['category'],
                        'status' => $templateData['status'],
                        'json' => json_encode($templateData),
                    ]
                );
            }

            $templates = Template::where('whatsapp_business_id', $whatsapp_business_id)->get();

            return $templates;
        } else {
            // return response()->json(['error' => 'Failed to fetch templates', 'message' => $e->getMessage()], 500);
            return response()->json(['error' => 'Failed to fetch templates', 'message' => $response->body()], 500);
        }
    }

    public function getTemplateDetail(Request $request)
    {
        $template = Template::find($request->template_id);
        // Llama a la función renderWhatsAppTemplate
        $templateDetail = $this->renderWhatsAppTemplate($template->json, $template->template_id, $template->wa_template_id);

        return $templateDetail;
    }

    public function getTemplateJson(Request $request)
    {
        $template = Template::find($request->id);
        return json_decode($template->json);
    }

    public function createTemplate(Request $request)
    {
        // $wa_account = WhatsappBusinessAccount::find($request->wa_id);
        $wa_account = WhatsappBusinessAccount::find('462194216974157');

        // Enviar el mensaje a la API de WhatsApp
        $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $wa_account->whatsapp_business_id . '/message_templates';
        $apiToken = $wa_account->api_token;

        $jsonBody = json_decode($request->input('jsonBody'), true);

        if ($request->hasFile('header_file')) {
            $file = $request->file('header_file');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileType = $file->getMimeType();
            $filePath = $file->getPathname();

            $path = $file->store('public/uploads');
            $multimedia_url = asset(Storage::url($path)); // Obtener la URL completa pública del archivo

            LOG::info('Multimedia URL: ' . $multimedia_url);

            // Paso 1: Iniciar una sesión de subida
            $appId = $wa_account->app_id;
            $accessToken = $apiToken;
            $initUploadUrl = "https://graph.facebook.com/v22.0/{$appId}/uploads?file_name=465001370_901034971594679_739546611693949742_n.jpg&file_length=87605&file_type=image/jpeg&access_token=EAAPbbWqWJo8BO3IsgkLgUx4CjGNExVDCWW03bYhr8RqldQrUKuQWkrCZBZAYMddEIGqFOAGM806os8GGf6ippT8savgjALvXRm0ZAkf12MQ11BIdxSJTvljYD91JlAGksxEbSlpgojXvy89Vf3muMcZBoVmyk3FdLCaWT3uyXkedZAj7ppgE3qheaYzLUWzgBXAZDZD";

            Log::info('Init Upload URL: ' . $initUploadUrl);

            $initResponse = Http::post($initUploadUrl, [], []);

            if (!$initResponse->successful()) {
                Log::error('Error al iniciar la sesión de subida', ['response' => $initResponse->json()]);
                return response()->json(['error' => 'Error al iniciar la sesión de subida'], 500);
            }

            LOG::info('response: ', [''=> $initResponse->json()]);

            $uploadSessionId = $initResponse->json('id');

            // Paso 2: Comenzar la subida
            $uploadUrl = "https://graph.facebook.com/v22.0/{$uploadSessionId}";

            LOG::info("Second pass: ". $uploadUrl);

            $uploadResponse = Http::withHeaders([
                'Authorization' => "OAuth {$accessToken}",
                'Content-Type' => $fileType,
                'file_offset' => 0,
            ])->attach('file', file_get_contents($filePath), $fileName)
            ->post($uploadUrl);

            if (!$uploadResponse->successful()) {
                Log::error('Error al subir el archivo', ['response' => $uploadResponse->json()]);
                return response()->json(['error' => 'Error al subir el archivo'], 500);
            }

            $uploadedFileHandle = $uploadResponse->json('h');

            LOG::info('Uploaded File Handle: ', ['handle' => $uploadedFileHandle]);

            // Encuentra el componente HEADER y actualiza el campo de archivo
            foreach ($jsonBody['components'] as &$component) {
                if ($component['type'] === 'HEADER' && isset($component['format']) && in_array($component['format'], ['IMAGE', 'VIDEO', 'DOCUMENT'])) {
                    $component['example'] = [
                        'header_handle' => [$uploadedFileHandle]
                    ];
                    break;
                }
            }
        }

        $payload = $jsonBody;

        Log::info('Create Template: ', ['payload' => $payload]);

        $response = Http::withToken($apiToken)->post($apiUrl, $payload);

        if ($response->successful()) {
            $templateId = $response->json('id');

            // Obtener la plantilla creada
            $templateUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $templateId;
            $templateResponse = Http::withToken($apiToken)->get($templateUrl);

            if ($templateResponse->successful()) {
                $templateData = $templateResponse->json();



                // Guardar la plantilla en la base de datos
                $template_tmp = Template::updateOrCreate(
                    ['wa_template_id' => $templateData['id']],
                    [
                        'whatsapp_business_id' => $wa_account->whatsapp_business_id,
                        'name' => $templateData['name'],
                        'language' => $templateData['language'],
                        'category' => $templateData['category'],
                        'status' => $templateData['status'],
                        'file' => $multimedia_url ?? null,
                        'json' => json_encode($templateData),
                    ]
                );

                LOG::info('Template created: ', ['template' => $template_tmp]);

                return response()->json(['message' => 'Plantilla creada y guardada con éxito.', 'template' => $templateData], 200);
            } else {
                Log::error('Error al obtener la plantilla', ['response' => $templateResponse->json()]);
                return response()->json(['error' => 'Error al obtener la plantilla'], 500);
            }
        } else {
            $error = $response->json('error');
            return response()->json([
                'message' => $error['message'] ?? 'Error desconocido',
                'type' => $error['type'] ?? 'Error',
                'code' => $error['code'] ?? 500,
                'error_subcode' => $error['error_subcode'] ?? null,
                'is_transient' => $error['is_transient'] ?? false,
                'error_user_title' => $error['error_user_title'] ?? null,
                'error_user_msg' => $error['error_user_msg'] ?? 'Hubo un error al crear la plantilla. Por favor, intenta de nuevo.',
                'fbtrace_id' => $error['fbtrace_id'] ?? null
            ], $response->status());
        }
    }

    public function updateTemplate(Request $request)
    {
        $template = Template::where('wa_template_id', $request->templateId)->first();
        $wa_account = WhatsappBusinessAccount::find($template->whatsapp_business_id);

        // Enviar el mensaje a la API de WhatsApp
        $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $request->templateId;
        $apiToken = $wa_account->api_token;

        $payload = $request->jsonBody;

        Log::info('Edit Template: ', ['payload' => $payload]);

        $response = Http::withToken($apiToken)->post($apiUrl, $payload);

        if ($response->successful()) {
            return response()->json(['message' => 'Solicitud de Actualizacion de plantilla enviada con éxito.'], 200);
        } else {
            return response()->json(['error' => $response->json()], $response->status());
        }
    }

    public static function renderWhatsAppTemplate($json, $template_id, $wa_template_id)
    {
        $template = json_decode($json, true);
        $html = '<div class="wb-template col-md-8 col-sm-8 col-12">
                    <div class="plantilla-card plantilla-card-header bg-gradient-success">
                        <div class="">
                            <div class="factura-title d-flex justify-content-between align-items-center">
                                <a>' . htmlspecialchars($template['name']) . '</a>
                            </div>
                        </div>
                    </div>
                    <div class="plantilla-card plantilla-card-content">
                        <div class="">
                            <div class="">';

        foreach ($template['components'] as $component) {
            switch ($component['type']) {
                case 'HEADER':
                    if (isset($component['format'])) {
                        switch ($component['format']) {
                            case 'IMAGE':
                                if (isset($component['example']['header_handle'][0])) {
                                    $headerImage = $component['example']['header_handle'][0];
                                    $html .= '<div class="plantilla-header"><img src="' . htmlspecialchars($headerImage) . '" alt="Header Image" style="max-width: 100%; height: auto;"></div>';
                                }
                                break;
                            case 'VIDEO':
                                if (isset($component['example']['header_handle'][0])) {
                                    $headerVideo = $component['example']['header_handle'][0];
                                    $html .= '<div class="plantilla-header"><video controls style="max-width: 100%; height: auto;"><source src="' . htmlspecialchars($headerVideo) . '" type="video/mp4">Your browser does not support the video tag.</video></div>';
                                }
                                break;
                            case 'AUDIO':
                                if (isset($component['example']['header_handle'][0])) {
                                    $headerAudio = $component['example']['header_handle'][0];
                                    $html .= '<div class="plantilla-header"><audio controls style="max-width: 100%; height: auto;"><source src="' . htmlspecialchars($headerAudio) . '" type="audio/mpeg">Your browser does not support the audio element.</audio></div>';
                                }
                                break;
                            default:
                                $headerText = isset($component['text']) ? (isset($component['example']['header_text']) ? self::replaceParameters($component['text'], $component['example']['header_text']) : $component['text']) : '';
                                $html .= '<div class="plantilla-header"><span>' . $headerText . '</span></div>';
                                break;
                        }
                    }
                    break;

                case 'BODY':
                    $bodyText = isset($component['text']) ? (isset($component['example']['body_text'][0]) ? self::replaceParameters($component['text'], $component['example']['body_text'][0]) : $component['text']) : '';
                    $html .= '<div class="plantilla-body"><span>' . nl2br($bodyText) . '</span></div>';
                    break;

                case 'FOOTER':
                    $footerText = isset($component['text']) ? htmlspecialchars($component['text']) : '';
                    $html .= '<div class="plantilla-footer"><span>' . $footerText . '</span></div>';
                    break;
            }
        }

        // Hora como pie de página alineada a la derecha
        $html .= '<div class="plantilla-time"><time aria-hidden="true" class="">4:33 pm</time></div>';

        // Añadir los botones al final
        foreach ($template['components'] as $component) {
            if ($component['type'] === 'BUTTONS') {
                foreach ($component['buttons'] as $button) {
                    $buttonUrl = isset($button['url']) ? (isset($button['example'][0]) ? str_replace('{{1}}', $button['example'][0], $button['url']) : $button['url']) : '#';
                    $buttonText = isset($button['text']) ? htmlspecialchars($button['text']) : '';
                    $html .= '<div class="plantilla-button"><div class=""><a href="#" class="">' . $buttonText . '</a></div></div>';
                }
            }
        }

        $html .= '</div></div></div></div>';
        return $html;
    }

    public function sendTemplate(Request $request)
    {
        $templateId = $request->input('send_template_id');
        $countryCode = ltrim($request->input('countryCode'), '+');
        $phoneNumber = $request->input('phoneNumber');
        $recipient = $countryCode . $phoneNumber;

        // Obtener los parámetros del formulario
        $params = array_filter($request->all(), function($key) {
            return strpos($key, 'param_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        if ($templateId && $recipient) {
            // Obtener la plantilla desde la base de datos
            $template = Template::where('template_id', $templateId)->first();
            $wa_account = WhatsappBusinessAccount::find($template->whatsapp_business_id)->phoneNumbers->first();

            if ($template) {
                $templateJson = json_decode($template->json, true);

                // Construir el cuerpo de la solicitud
                $components = [];

                // Procesar HEADER primero
                foreach ($templateJson['components'] as $component) {
                    if ($component['type'] === 'HEADER') {
                        $componentData = ['type' => 'header'];
                        if (isset($component['format'])) {
                            switch ($component['format']) {
                                case 'IMAGE':
                                    if (isset($component['example']['header_handle'][0])) {
                                        $headerImage = $component['example']['header_handle'][0];
                                        $componentData['parameters'][] = [
                                            'type' => 'image',
                                            'image' => ['link' => $headerImage]
                                        ];
                                    }
                                    break;
                                case 'VIDEO':
                                    if (isset($component['example']['header_handle'][0])) {
                                        $headerVideo = $component['example']['header_handle'][0];
                                        $componentData['parameters'][] = [
                                            'type' => 'video',
                                            'video' => ['link' => $headerVideo]
                                        ];
                                    }
                                    break;
                                case 'AUDIO':
                                    if (isset($component['example']['header_handle'][0])) {
                                        $headerAudio = $component['example']['header_handle'][0];
                                        $componentData['parameters'][] = [
                                            'type' => 'audio',
                                            'audio' => ['link' => $headerAudio]
                                        ];
                                    }
                                    break;
                                default:
                                    if (isset($component['text']) && strpos($component['text'], '{{') !== false) {
                                        $headerText = $component['text'];
                                        preg_match('/{{(\d+)}}/', $headerText, $match);
                                        if (isset($match[1])) {
                                            $paramKey = 'param_HEADER_' . ($match[1] - 1);
                                            if (isset($params[$paramKey])) {
                                                $headerText = $params[$paramKey];
                                                $componentData['parameters'][] = [
                                                    'type' => 'text',
                                                    'text' => $headerText
                                                ];
                                            }
                                        }
                                    }
                                    break;
                            }
                        }
                        $components[] = $componentData;
                    }
                }

                // Procesar BODY y BUTTONS después
                foreach ($templateJson['components'] as $component) {
                    if ($component['type'] === 'FOOTER' || $component['type'] === 'HEADER') {
                        continue; // Omitir el componente FOOTER y HEADER ya procesado
                    }

                    $componentData = ['type' => strtolower($component['type'])];

                    if (isset($component['text']) && strpos($component['text'], '{{') !== false) {
                        $componentData['parameters'] = [];
                        preg_match_all('/{{(\d+)}}/', $component['text'], $matches);
                        foreach ($matches[1] as $index) {
                            $paramKey = 'param_' . strtoupper($component['type']) . '_' . ($index - 1);
                            if (isset($params[$paramKey])) {
                                $componentData['parameters'][] = [
                                    'type' => 'text',
                                    'text' => $params[$paramKey]
                                ];
                            }
                        }
                    }

                    if ($component['type'] === 'BUTTONS') {
                        foreach ($component['buttons'] as $index => $button) {
                            $buttonComponent = [
                                'type' => 'button',
                                'sub_type' => $button['type'] === 'URL' ? 'url' : 'quick_reply',
                                'index' => (string)$index,
                                'parameters' => []
                            ];
                            if ($button['type'] === 'URL') {
                                $url = $button['url'];
                                preg_match('/{{(\d+)}}/', $url, $match);
                                if (isset($match[1])) {
                                    $paramKey = 'param_BUTTON_0_' . ($match[1] - 1);
                                    if (isset($params[$paramKey])) {
                                        // $url = str_replace($match[0], $params[$paramKey], $url);
                                        $url = $params[$paramKey];
                                        $buttonComponent['parameters'][] = [
                                            'type' => 'payload',
                                            'payload' => $url
                                        ];
                                    }
                                }
                            }
                            if (!empty($buttonComponent['parameters'])) {
                                $components[] = $buttonComponent;
                            }
                        }
                    } else {
                        if (!empty($componentData['parameters'])) {
                            $components[] = $componentData;
                        }
                    }
                }

                // Construir el payload para la API de WhatsApp
                $payload = [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $recipient,
                    'type' => 'template',
                    'template' => [
                        'name' => $templateJson['name'],
                        'language' => [
                            'code' => $templateJson['language']
                        ],
                        'components' => $components
                    ]
                ];

                // Enviar el mensaje a la API de WhatsApp
                $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $wa_account->phone_number_id . '/messages';
                $apiToken = $wa_account->businessAccount->api_token;

                // Log::debug('WhatsApp API Petition', ['url' => $apiUrl, 'payload' => $payload, 'api_token' => $apiToken]);

                Log::info('Send Template: ', ['payload' => $payload]);

                $response = Http::withToken($apiToken)->post($apiUrl, $payload);

                // Log::debug('WhatsApp API Response', ['response' => $response->json()]);

                if ($response->successful()) {
                    // Almacenar el contacto si no existe
                    $contact = Contact::firstOrCreate(
                        ['wa_id' => $recipient],
                        ['country_code' => $countryCode, 'phone_number' => $phoneNumber]
                    );

                    // Formatear el payload en HTML
                    $messageContent = $this->formatPayloadToHtml($payload);

                    // Almacenar el mensaje en la base de datos
                    $message = new Message();
                    $message->whatsapp_phone_id = $wa_account->whatsapp_phone_id;
                    $message->contact_id = $contact->contact_id;
                    $message->messaging_product = 'whatsapp';
                    $message->message_type = 'TEMPLATE';
                    $message->message_method = 'OUTPUT';
                    $message->message_from = $wa_account->display_phone_number;
                    $message->message_to = $recipient;
                    $message->wa_id = $response->json('messages')[0]['id'];
                    $message->message_content = $messageContent; // Almacenar el HTML formateado
                    $message->json_content = json_encode($payload); // Almacenar el JSON enviado a la API
                    $message->json = $response->body(); // Almacenar la respuesta de la API
                    $message->save();

                    return response()->json(['message' => 'Mensaje enviado con éxito.'], 200);
                } else {
                    return response()->json(['error' => $response->json()], $response->status());
                }
            }
        }

        return response()->json(['error' => 'Datos incompletos.'], 400);
    }

    public static function replaceParameters($text, $parameters)
    {
        foreach ($parameters as $index => $param) {
            $placeholder = '{{' . ($index + 1) . '}}';
            $text = str_replace($placeholder, htmlspecialchars($param), $text);
        }
        return $text;
    }

    private function formatPayloadToHtml($payload)
    {
        $html = '<div class="whatsapp-message">';
        $html .= '<p><strong>To:</strong> ' . htmlspecialchars($payload['to']) . '</p>';
        $html .= '<p><strong>Template:</strong> ' . htmlspecialchars($payload['template']['name']) . '</p>';
        $html .= '<p><strong>Language:</strong> ' . htmlspecialchars($payload['template']['language']['code']) . '</p>';

        foreach ($payload['template']['components'] as $component) {
            $html .= '<div class="component">';
            $html .= '<p><strong>Type:</strong> ' . htmlspecialchars($component['type']) . '</p>';
            if (isset($component['parameters'])) {
                foreach ($component['parameters'] as $parameter) {
                    $html .= '<p><strong>Parameter:</strong> ' . htmlspecialchars($parameter['type']) . ' - ' . htmlspecialchars($parameter['text'] ?? $parameter['payload'] ?? '') . '</p>';
                }
            }
            if (isset($component['buttons'])) {
                foreach ($component['buttons'] as $button) {
                    $html .= '<p><strong>Button:</strong> ' . htmlspecialchars($button['sub_type']) . ' - ' . htmlspecialchars($button['parameters'][0]['payload'] ?? '') . '</p>';
                }
            }
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }
}
