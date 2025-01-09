<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Template;
use App\Models\WhatsappBusinessAccount;
use App\Models\WhatsappPhoneNumber;
use App\Models\WhatsappBusinessProfile;
use App\Models\Website;
use Illuminate\Support\Facades\Log;

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
            Log::info('Phone numbers fetched', ['phoneNumbers' => $phoneNumbers]);

            foreach ($phoneNumbers as $phoneNumber) {
                $cleanedPhoneNumber = preg_replace('/\D/', '', $phoneNumber['display_phone_number']);
                Log::info('Processing phone number', ['phoneNumber' => $phoneNumber]);

                // Buscar si el número de teléfono ya existe
                $phoneNumberRecord = WhatsappPhoneNumber::where('phone_number_id', $phoneNumber['id'])->first();

                // Obtener el perfil del número de teléfono
                $profileData = $this->fetchPhoneNumberProfile($api_token, $phoneNumber['id']);
                $profileData = $profileData['data'][0];
                Log::info('Profile data fetched', ['profileData' => $profileData]);

                if ($phoneNumberRecord) {
                    // Actualizar el número de teléfono existente
                    $phoneNumberRecord->update([
                        'display_phone_number' => $cleanedPhoneNumber,
                        'verified_name' => $phoneNumber['verified_name'],
                    ]);
                    Log::info('Phone number updated', ['phoneNumberRecord' => $phoneNumberRecord]);

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
                        Log::info('Profile updated', ['profileRecord' => $profileRecord]);
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
                        Log::info('New profile created', ['profileRecord' => $profileRecord]);

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
                    Log::info('New phone number created', ['phoneNumberRecord' => $phoneNumberRecord]);

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
                    Log::info('New profile created', ['profileRecord' => $profileRecord]);

                    $phoneNumberRecord->update([
                        'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                    ]);
                }

                // Guardar los sitios web
                if (isset($profileData['websites'])) {
                    // Eliminar sitios web existentes
                    Website::where('whatsapp_business_profile_id', $profileRecord->whatsapp_business_profile_id)->delete();
                    Log::info('Existing websites deleted', ['profileRecord' => $profileRecord]);

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
                            Log::info('New website created', ['website' => $website]);
                        } else {
                            Log::info('Website already exists', ['website' => $website]);
                        }
                    }
                }
            }

            // Confirmar la transacción
            DB::commit();
            Log::info('Transaction committed');

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

    public function updateTemplate(Request $request)
    {
        $template = Template::where('wa_template_id', $request->templateId)->first();
        $wa_account = WhatsappBusinessAccount::find($template->whatsapp_business_id);

        // Enviar el mensaje a la API de WhatsApp
        $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $request->templateId;
        $apiToken = $wa_account->api_token;

        $payload = $request->jsonBody;

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
        $html = '<div class="wb-template col-md-6 col-sm-6 col-12">
                    <div class="plantilla-card plantilla-card-header bg-gradient-success">
                        <div class="">
                            <div class="factura-title d-flex justify-content-between align-items-center">
                                <a>' . htmlspecialchars($template['name']) . '</a>
                                <!--
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a class="dropdown-item modal-editTemplate" href="#" data-template-name="' . htmlspecialchars($template['name']) . '" data-template-id="' . $template_id . '" data-template-wa-id="' . $wa_template_id . '">Editar Plantilla</a>
                                        <a class="dropdown-item modal-detailTemplate" href="#" data-template-name="' . htmlspecialchars($template['name']) . '" data-template-id="' . $template_id . '" data-template-wa-id="' . $wa_template_id . '">Detalles de Plantilla</a>
                                        <a class="dropdown-item modal-sendTemplate" href="#" data-template-name="' . htmlspecialchars($template['name']) . '" data-template-id="' . $template_id . '" data-template-wa-id="' . $wa_template_id . '">Enviar Plantilla</a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item modal-deleteTemplate" href="#">Eliminar Plantilla</a>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                    <div class="plantilla-card plantilla-card-content">
                        <div class="">
                            <div class="">';

        foreach ($template['components'] as $component) {
            switch ($component['type']) {
                case 'HEADER':
                    $headerText = isset($component['text']) ? (isset($component['example']['header_text']) ? self::replaceParameters($component['text'], $component['example']['header_text']) : $component['text']) : '';
                    $html .= '<div class="plantilla-header"><span>' . $headerText . '</span></div>';
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
                $mensaje = ""; // Variable para construir el mensaje

                foreach ($templateJson['components'] as $component) {
                    $componentType = strtolower($component['type']);
                    if ($componentType === 'footer') {
                        continue; // Ignorar el componente footer
                    }

                    $componentData = ['type' => $componentType];

                    if (isset($component['text'])) {
                        $parameters = [];
                        $matches = [];
                        preg_match_all('/{{\d+}}/', $component['text'], $matches);
                        $text = $component['text'];
                        foreach ($matches[0] as $index => $match) {
                            $paramValue = $params["param_{$component['type']}_{$index}"] ?? '';
                            $text = str_replace($match, $paramValue, $text);
                            $parameters[] = [
                                'type' => 'text',
                                'text' => $paramValue
                            ];
                        }
                        $mensaje .= $text . "\n"; // Agregar el texto al mensaje
                        if (!empty($parameters)) {
                            $componentData['parameters'] = $parameters;
                        }
                        $components[] = $componentData;
                    } elseif ($componentType === 'buttons' && isset($component['buttons']) && count($component['buttons']) > 0) {
                        foreach ($component['buttons'] as $buttonIndex => $button) {
                            $parameters = [];
                            if (isset($button['url'])) {
                                $matches = [];
                                preg_match_all('/{{\d+}}/', $button['url'], $matches);
                                foreach ($matches[0] as $index => $match) {
                                    $parameters[] = [
                                        'type' => 'text',
                                        'text' => $params["param_BUTTON_{$buttonIndex}_{$index}"] ?? ''
                                    ];
                                }
                            } elseif (isset($button['parameters'])) {
                                $parameters = $button['parameters'];
                            }

                            $components[] = [
                                'type' => 'button',
                                'sub_type' => strtolower($button['type']),
                                'index' => $buttonIndex,
                                'parameters' => $parameters
                            ];
                        }
                    } elseif (isset($component['parameters'])) {
                        $componentData['parameters'] = $component['parameters'];
                        $components[] = $componentData;
                    } else {
                        $components[] = $componentData;
                    }
                }

                // Construir el cuerpo de la solicitud JSON
                $requestBody = [
                    'messaging_product' => 'whatsapp',
                    'to' => $recipient,
                    'type' => 'template',
                    'template' => [
                        'name' => $templateJson['name'],
                        'language' => [
                            'code' => $templateJson['language'],
                            'policy' => 'deterministic'
                        ],
                        'components' => $components
                    ]
                ];

                // Enviar la solicitud a la API de WhatsApp
                $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $wa_account->phone_number_id . '/messages';
                $apiToken = $wa_account->api_token;

                // dd($apiUrl, $requestBody);
                // exit();

                $response = Http::withToken($apiToken)->post($apiUrl, $requestBody);

                if ($response->successful()) {
                    $responseData = $response->json();
                    if (isset($responseData['messages'][0]['id'])) {
                        $messageId = $responseData['messages'][0]['id'];
                        // Guardar el mensaje en la base de datos
                        DB::table('mensaje_whatsapp')->insert([
                            'celular' => $recipient,
                            'mensaje' => $mensaje,
                            'tipo' => 'SALIDA',
                            'type' => 'TEMPLATE',
                            'fechaenvio' => now(),
                            'wb_message_id' => $messageId
                        ]);
                        return response()->json(['success' => 'Mensaje enviado correctamente', 'message_id' => $messageId], 200);
                    } else {
                        return response()->json(['error' => 'Error en la respuesta de la API de WhatsApp', 'response' => $responseData], 500);
                    }
                } else {
                    return response()->json(['error' => $response->json()], $response->status());
                }
            } else {
                return response()->json(['error' => 'Plantilla no encontrada'], 404);
            }
        } else {
            return response()->json(['error' => 'Datos incompletos para enviar la plantilla'], 400);
        }
    }

    public static function replaceParameters($text, $parameters)
    {
        foreach ($parameters as $index => $param) {
            $placeholder = '{{' . ($index + 1) . '}}';
            $text = str_replace($placeholder, htmlspecialchars($param), $text);
        }
        return $text;
    }
}
