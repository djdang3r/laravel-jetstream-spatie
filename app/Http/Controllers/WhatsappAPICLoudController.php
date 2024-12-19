<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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

    public function getPhoneNumbers($whatsapp_business_id)
    {
        // Obtener el api_token de la base de datos
        $account = WhatsappBusinessAccount::find($whatsapp_business_id);

        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        $api_token = $account->api_token;

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener los números de teléfono
            $phoneNumbers = $this->fetchPhoneNumbers($api_token, $whatsapp_business_id);

            

            foreach ($phoneNumbers as $phoneNumber) {
                $cleanedPhoneNumber = preg_replace('/\D/', '', $phoneNumber['display_phone_number']);

                // Obtener el perfil del número de teléfono
                $profileData = $this->fetchPhoneNumberProfile($api_token, $phoneNumber['id']);

                $profileRecord = WhatsappBusinessProfile::updateOrCreate(
                    ['whatsapp_business_profile_id' => $phoneNumber['id']],
                    [
                        'about' => $profileData['about'] ?? null,
                        'address' => $profileData['address'] ?? null,
                        'description' => $profileData['description'] ?? null,
                        'email' => $profileData['email'] ?? null,
                        'profile_picture_url' => $profileData['profile_picture_url'] ?? null,
                        'vertical' => $profileData['vertical'] ?? null,
                        'messaging_product' => $profileData['messaging_product'] ?? null,
                    ]
                );

                $phoneNumberRecord = WhatsappPhoneNumber::updateOrCreate(
                    ['phone_number_id' => $phoneNumber['id']],
                    [
                        'whatsapp_business_accounts_id' => $whatsapp_business_id,
                        'display_phone_number' => $cleanedPhoneNumber,
                        'verified_name' => $phoneNumber['verified_name'],
                        'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                        // 'code_verification_status' => $phoneNumber['code_verification_status'],
                        // 'quality_rating' => $phoneNumber['quality_rating'],
                        // 'platform_type' => $phoneNumber['platform_type'],
                        // 'throughput_level' => $phoneNumber['throughput']['level'],
                        // 'webhook_configuration' => $phoneNumber['webhook_configuration']['application'] ?? null,
                    ]
                );

                // Guardar los sitios web
                if (isset($profileData['websites'])) {
                    // Eliminar sitios web existentes
                    Website::where('whatsapp_business_profile_id', $profileRecord->whatsapp_business_profile_id)->delete();

                    // Guardar nuevos sitios web
                    foreach ($profileData['websites'] as $website) {
                        Website::create([
                            'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                            'website' => $website,
                        ]);
                    }
                }
            }

            // Confirmar la transacción
            DB::commit();

            // Devolver la respuesta
            return response()->json($phoneNumbers);

        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['error' => 'Failed to fetch phone numbers or profiles', 'message' => $e->getMessage()], 500);
        }
    }

    private function fetchPhoneNumbers($api_token, $whatsapp_business_id)
    {
        $api_url = "https://graph.facebook.com/";
        $api_version = "21.0";
        $url = "{$api_url}{$api_version}/{$whatsapp_business_id}/phone_numbers";
        Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);

        if ($response->successful()) {
            return $response->json()['data'];
        } else {
            throw new \Exception("Failed to fetch phone numbers: " . $response->body());
        }
    }

    private function fetchPhoneNumberProfile($api_token, $phone_number_id)
    {
        // $api_url = env('WHATSAPP_API_URL');
        // $api_version = env('WHATSAPP_API_VERSION');
        $api_url = "https://graph.facebook.com/";
        $api_version = "21.0";
        $api_token = "EAAKt6D2DgZCMBO59rFHbFg17VnSpoWq8uragjFda4w4dPDuZALV1uO2MmU0zRQa1DtcbBUzvp4UohZCrLBuKrdqMdXNzRqio0MuSxZABFUZBbWFUztmMHLYd0l94Iq4C0AfmrThVNLbZCxVFcjmiiUn2c6ZBaNphphqtZA1tzyJxGj0Khsy9d0cKpYFMoRRbMrqZCbAZDZD";
        $url = "{$api_url}{$api_version}/{$phone_number_id}/whatsapp_business_profile?fields=about,address,description,email,profile_picture_url,websites,vertical";
        Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception("Failed to fetch phone number profile: " . $response->body());
        }
    }
}
