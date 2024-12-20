<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\WhatsappPhoneNumber;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WhatsappChatController extends Controller
{
    public function whatsappIndex()
    {
        return view('whatsapp_chat.index');
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'celular' => 'required|string',
            'tipo' => 'required|string', // 'INPUT' o 'OUTPUT'
            'type' => 'required|string', // 'TEXT', 'IMAGE', etc.
            'media_url' => 'nullable|string',
            'phone_number_id' => 'required|string',
            'mensaje' => 'nullable|string',
        ]);

        $country_code = substr($data['celular'], 0, 2); // Asumiendo que el código del país tiene 2 dígitos
        $phone_number = substr($data['celular'], 2);

        DB::beginTransaction();

        try {
            // Verificar si el contacto existe en la tabla whatsapp_contacts
            $contact = Contact::firstOrCreate(
                ['wa_id' => $data['celular']],
                ['country_code' => $country_code, 'name' => $data['celular']]
            );

            $whatsapp_phone = WhatsappPhoneNumber::find($data['phone_number_id']);

            // Enviar el mensaje a la API de WhatsApp
            $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $whatsapp_phone->phone_number_id . '/messages';
            $apiToken = $whatsapp_phone->businessAccount->api_token;

            $payload = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $data['celular'],
                'type' => 'text',
                'text' => [
                    'preview_url' => false,
                    'body' => $data['mensaje']
                ]
            ];

            $response = Http::withToken($apiToken)->post($apiUrl, $payload);

            // Agregar registro de depuración para la respuesta
            Log::debug('WhatsApp API Response', ['response' => $response->json()]);

            if ($response->successful()) {
                // Almacenar el mensaje en la base de datos si la solicitud a la API fue exitosa
                $message = new Message();
                $message->whatsapp_phone_id = $whatsapp_phone->whatsapp_phone_id;
                $message->contact_id = $contact->contact_id;
                $message->messaging_product = 'whatsapp';
                $message->message_type = $data['type'];
                $message->message_method = $data['tipo'];
                $message->message_from = $whatsapp_phone->display_phone_number;
                $message->message_to = $data['celular'];
                $message->wa_id = $response->json('messages')[0]['id'];
                $message->message_content = $data['mensaje'];
                $message->json_content = json_encode($payload); // Almacenar el JSON enviado a la API
                $message->json = $response->body(); // Almacenar la respuesta de la API
                $message->save();

                DB::commit();

                return response()->json(["success" => true]);
            } else {
                DB::rollBack();
                Log::error('Error al enviar el mensaje a la API de WhatsApp', ['response' => $response->body()]);
                return response()->json(["error" => "Error al enviar el mensaje a la API de WhatsApp", "response" => $response->body()]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar la solicitud', ['message' => $e->getMessage()]);
            return response()->json(["error" => "Error al procesar la solicitud", "message" => $e->getMessage()]);
        }
    }
}