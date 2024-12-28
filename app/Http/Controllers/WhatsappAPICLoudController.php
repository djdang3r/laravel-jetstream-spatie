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
}
