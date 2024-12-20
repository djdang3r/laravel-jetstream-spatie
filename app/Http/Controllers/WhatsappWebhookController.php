<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Message;
use App\Models\MediaFile;
use App\Models\Contact;
use App\Models\Conversation;
use App\Models\WhatsappPhoneNumber;
use App\Models\WhatsappBusinessAccount;

class WhatsappWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $mytoken = env('WHATSAPP_VERIFY_TOKEN');

        // Manejar solicitudes GET (verificación del webhook)
        if ($request->isMethod('get') && $request->has(['hub_mode', 'hub_challenge', 'hub_verify_token'])) {
            $mode = $request->query('hub_mode');
            $challenge = $request->query('hub_challenge');
            $verify_token = $request->query('hub_verify_token');

            Log::info('Webhook verification request received.', [
                'mode' => $mode,
                'challenge' => $challenge,
                'verify_token' => $verify_token,
                'expected_token' => $mytoken,
            ]);

            if ($mode === 'subscribe' && $verify_token === $mytoken) {
                Log::info('Webhook verification successful.');
                return response($challenge, 200);
            } else {
                Log::error('Webhook verification failed: Invalid token.');
                return response()->json(['error' => 'Invalid token'], 403);
            }
        }

        // Manejar solicitudes POST (procesar mensajes entrantes)
        if ($request->isMethod('post')) {
            $input = $request->all();

            // Registrar el contenido de la solicitud para depuración
            Log::info('Webhook received: ' . print_r($input, true));

            // Verifica que el mensaje está en el formato esperado
            if (isset($input['entry'][0]['changes'][0]['value']['messages'][0])) {
                $value = $input['entry'][0]['changes'][0]['value'];
                $metadata = $value['metadata'];
                $contacts = $value['contacts'][0];
                $messages = $value['messages'][0];

                $whatsapp_phone = WhatsappPhoneNumber::where('phone_number_id', $metadata['phone_number_id'])->first();
                $whatsapp_business = WhatsappBusinessAccount::where('whatsapp_business_id', $whatsapp_phone->whatsapp_business_accounts_id)->first();

                // Extrae el teléfono
                $celular = $messages['from'];

                // Verifica el tipo de mensaje
                $tipoMensaje = $messages['type'];

                // Procesa el contacto
                $contact = Contact::firstOrCreate(
                    ['wa_id' => $contacts['wa_id']],
                    [
                        'country_code' => substr($contacts['wa_id'], 0, 2),
                        'phone_number' => substr($contacts['wa_id'], 2),
                        'contact_name' => $contacts['profile']['name'] ?? null,
                    ]
                );

                // Procesa la conversación
                $conversation = Conversation::firstOrCreate(
                    ['wa_conversation_id' => $messages['id']],
                    [
                        'expiration_timestamp' => now()->addDays(30),
                        'origin' => 'whatsapp',
                        'pricing_model' => 'free',
                        'billable' => false,
                        'category' => 'user_initiated',
                    ]
                );

                // Procesa el mensaje de texto
                if ($tipoMensaje === 'text') {
                    $mensaje = $messages['text']['body'];
                    $type_message = strtoupper($tipoMensaje);

                    if (!empty($mensaje)) {
                        $message = Message::create([
                            'whatsapp_phone_id' => $whatsapp_phone->whatsapp_phone_id,
                            'contact_id' => $contact->contact_id,
                            'wa_id' => $messages['id'],
                            'conversation_id' => $conversation->conversation_id,
                            'messaging_product' => $value['messaging_product'],
                            'message_from' => $celular,
                            'message_to' => $whatsapp_phone->display_phone_number,
                            'message_type' => $type_message,
                            'message_content' => $mensaje,
                            'delivered_at' => now(),
                            'json_content' => json_encode($messages),
                        ]);

                        // Guarda el mensaje en el archivo text.txt
                        file_put_contents(storage_path('logs/text.txt'), 'Mensaje de Texto: ' . $mensaje . "\nCelular: " . $celular . "\n", FILE_APPEND);
                    }
                }

                // Procesa el mensaje de audio
                elseif ($tipoMensaje === 'audio') {
                    $type_message = strtoupper($tipoMensaje);

                    $message = Message::create([
                        'whatsapp_phone_id' => $whatsapp_phone->whatsapp_phone_id,
                        'contact_id' => $contact->contact_id,
                        'conversation_id' => $conversation->conversation_id,
                        'messaging_product' => $value['messaging_product'],
                        'message_from' => $celular,
                        'message_to' => $metadata['phone_number_id'],
                        'message_type' => $type_message,
                        'message_content' => 'AUDIO',
                        'json_content' => json_encode($messages),
                    ]);

                    // Guarda el mensaje en el archivo text.txt
                    file_put_contents(storage_path('logs/text.txt'), 'Mensaje de Texto: ' . 'AUDIO' . "\nCelular: " . $celular . "\n", FILE_APPEND);

                    // Extrae el ID del audio
                    $audioId = $messages['audio']['id'];
                    $type_message = strtoupper($tipoMensaje);

                    // Obtiene la URL del archivo de audio
                    $mediaUrl = $this->obtenerUrlDeMedia($audioId, $whatsapp_business, $whatsapp_phone);

                    if ($mediaUrl) {
                        // Realiza una petición para obtener el archivo de audio
                        $audioContent = $this->obtenerArchivoDeMedia($mediaUrl, $whatsapp_business);

                        if ($audioContent) {
                            // Asegúrate de que la carpeta exista
                            $directory = storage_path('app/public/whatsapp/audios/');
                            if (!file_exists($directory)) {
                                mkdir($directory, 0777, true);
                            }

                            // Guarda el archivo de audio en la carpeta deseada
                            $filePath = $directory . $audioId . '.ogg';
                            file_put_contents($filePath, $audioContent);

                            // Inserta los datos en la base de datos
                            MediaFile::create([
                                'message_id' => $message->message_id,
                                'media_type' => 'audio',
                                'file_name' => $audioId . '.ogg',
                                'url' => $filePath,
                                'media_id' => $audioId,
                                'mime_type' => $messages['audio']['mime_type'],
                                'sha256' => $messages['audio']['sha256'],
                            ]);

                            file_put_contents(storage_path('logs/text.txt'), 'Archivo de Audio guardado en: ' . $filePath . "\n", FILE_APPEND);
                        } else {
                            file_put_contents(storage_path('logs/text.txt'), 'Error al obtener el archivo de audio para ID: ' . $audioId . "\n", FILE_APPEND);
                        }
                    } else {
                        file_put_contents(storage_path('logs/text.txt'), 'Error al obtener la URL del audio para ID: ' . $audioId . "\n", FILE_APPEND);
                    }
                }

                // Procesa el mensaje de imagen
                elseif ($tipoMensaje === 'image') {
                    $type_message = strtoupper($tipoMensaje);

                    $message = Message::create([
                        'whatsapp_phone_id' => $whatsapp_phone->whatsapp_phone_id,
                        'contact_id' => $contact->contact_id,
                        'conversation_id' => $conversation->conversation_id,
                        'messaging_product' => $value['messaging_product'],
                        'message_from' => $celular,
                        'message_to' => $metadata['phone_number_id'],
                        'message_type' => $type_message,
                        'message_content' => 'IMAGE',
                        'json_content' => json_encode($messages),
                    ]);

                    // Guarda el mensaje en el archivo text.txt
                    file_put_contents(storage_path('logs/text.txt'), 'Mensaje de Texto: ' . 'IMAGE' . "\nCelular: " . $celular . "\n", FILE_APPEND);

                    // Extrae el ID de la imagen
                    $imageId = $messages['image']['id'];
                    $type_message = strtoupper($tipoMensaje);

                    // Obtiene la URL del archivo de imagen
                    $mediaUrl = $this->obtenerUrlDeMedia($imageId, $whatsapp_business, $whatsapp_phone);

                    if ($mediaUrl) {
                        // Realiza una petición para obtener el archivo de imagen
                        $imageContent = $this->obtenerArchivoDeMedia($mediaUrl, $whatsapp_business);

                        if ($imageContent) {
                            // Asegúrate de que la carpeta exista
                            $directory = storage_path('app/public/whatsapp/images/');
                            if (!file_exists($directory)) {
                                mkdir($directory, 0777, true);
                            }

                            // Guarda el archivo de imagen en la carpeta deseada
                            $filePath = $directory . $imageId . '.jpg';
                            file_put_contents($filePath, $imageContent);

                            // Inserta los datos en la base de datos
                            MediaFile::create([
                                'message_id' => $message->message_id,
                                'media_type' => 'image',
                                'file_name' => $imageId . '.jpg',
                                'url' => $filePath,
                                'media_id' => $imageId,
                                'mime_type' => $messages['image']['mime_type'],
                                'sha256' => $messages['image']['sha256'],
                            ]);

                            file_put_contents(storage_path('logs/text.txt'), 'Archivo de Imagen guardado en: ' . $filePath . "\n", FILE_APPEND);
                        } else {
                            file_put_contents(storage_path('logs/text.txt'), 'Error al obtener el archivo de imagen para ID: ' . $imageId . "\n", FILE_APPEND);
                        }
                    } else {
                        file_put_contents(storage_path('logs/text.txt'), 'Error al obtener la URL de la imagen para ID: ' . $imageId . "\n", FILE_APPEND);
                    }
                }

                // Procesa el mensaje de documento
                elseif ($tipoMensaje === 'document') {
                    $type_message = strtoupper($tipoMensaje);

                    $message = Message::create([
                        'whatsapp_phone_id' => $whatsapp_phone->whatsapp_phone_id,
                        'contact_id' => $contact->contact_id,
                        'conversation_id' => $conversation->conversation_id,
                        'messaging_product' => $value['messaging_product'],
                        'message_from' => $celular,
                        'message_to' => $metadata['phone_number_id'],
                        'message_type' => $type_message,
                        'message_content' => 'DOCUMENT',
                        'json_content' => json_encode($messages),
                    ]);

                    // Guarda el mensaje en el archivo text.txt
                    file_put_contents(storage_path('logs/text.txt'), 'Mensaje de Texto: ' . 'DOCUMENT' . "\nCelular: " . $celular . "\n", FILE_APPEND);

                    // Extrae el ID del documento
                    $documentId = $messages['document']['id'];
                    $type_message = strtoupper($tipoMensaje);

                    // Obtiene la URL del archivo de documento
                    $mediaUrl = $this->obtenerUrlDeMedia($documentId, $whatsapp_business, $whatsapp_phone);

                    if ($mediaUrl) {
                        // Realiza una petición para obtener el archivo de documento
                        $documentContent = $this->obtenerArchivoDeMedia($mediaUrl, $whatsapp_business);

                        if ($documentContent) {
                            // Asegúrate de que la carpeta exista
                            $directory = storage_path('app/public/whatsapp/documents/');
                            if (!file_exists($directory)) {
                                mkdir($directory, 0777, true);
                            }

                            // Guarda el archivo de documento en la carpeta deseada
                            $filePath = $directory . $documentId . '.pdf';
                            file_put_contents($filePath, $documentContent);

                            // Inserta los datos en la base de datos
                            MediaFile::create([
                                'message_id' => $message->message_id,
                                'media_type' => 'document',
                                'file_name' => $documentId . '.pdf',
                                'url' => $filePath,
                                'media_id' => $documentId,
                                'mime_type' => $messages['document']['mime_type'],
                                'sha256' => $messages['document']['sha256'],
                            ]);

                            file_put_contents(storage_path('logs/text.txt'), 'Archivo de Documento guardado en: ' . $filePath . "\n", FILE_APPEND);
                        } else {
                            file_put_contents(storage_path('logs/text.txt'), 'Error al obtener el archivo de documento para ID: ' . $documentId . "\n", FILE_APPEND);
                        }
                    } else {
                        file_put_contents(storage_path('logs/text.txt'), 'Error al obtener la URL del documento para ID: ' . $documentId . "\n", FILE_APPEND);
                    }
                }
                
            }

            // Verifica que el mensaje está en el formato esperado
            if (isset($input['entry'][0]['changes'][0]['value']['statuses'][0])) {
                $status = $input['entry'][0]['changes'][0]['value']['statuses'][0];
                $messageId = $status['id'];

                // Verifica si la conversación existe en la respuesta
                if (isset($status['conversation'])) {
                    $conversationId = $status['conversation']['id'];

                    // Verifica si la conversación existe y si no, la crea
                    $conversation = Conversation::firstOrCreate(
                        ['wa_conversation_id' => $conversationId],
                        [
                            'expiration_timestamp' => now()->addDays(30),
                            'origin' => $status['conversation']['origin']['type'] ?? 'unknown',
                            'pricing_model' => $status['pricing']['pricing_model'] ?? 'unknown',
                            'billable' => $status['pricing']['billable'] ?? false,
                            'category' => $status['pricing']['category'] ?? 'unknown',
                        ]
                    );

                    // Actualiza el campo conversation_id del mensaje correspondiente
                    $message = Message::where('wa_id', $messageId)->first();
                    if ($message) {
                        $message->conversation_id = $conversation->conversation_id;
                        if ($status['status'] === 'delivered') {
                            $message->delivered_at = now();
                        } 
                        $message->save();
                    }
                } else {
                    // Manejar el caso donde no hay conversación en la respuesta
                    Log::warning('No conversation data found in the status update', ['status' => $status]);
                }
            }

            // Manejar la actualización del estado read por separado
            if (isset($input['entry'][0]['changes'][0]['value']['statuses'][0])) {
                $status = $input['entry'][0]['changes'][0]['value']['statuses'][0];
                $messageId = $status['id'];

                // Actualiza el campo readed_at del mensaje correspondiente
                if ($status['status'] === 'read') {
                    $message = Message::where('wa_id', $messageId)->first();
                    if ($message) {
                        $message->readed_at = now();
                        $message->save();
                    }
                }
            }

            return response()->json(['status' => 'success'], 200);
        }
    }

    // Función para obtener la URL del archivo a partir del mediaId
    private function obtenerUrlDeMedia($mediaId, $whatsapp_business, $whatsapp_phone)
    {
        $token = $whatsapp_business->api_token;
        $url = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . "/$mediaId?phone_number_id=" . $whatsapp_phone->phone_number_id;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);

        $responseData = $response->json();
        return $responseData['url'] ?? null;
    }

    // Función para obtener el archivo a partir de la URL
    private function obtenerArchivoDeMedia($url, $whatsapp_business)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $whatsapp_business->api_token,
        ])->get($url);

        return $response->body();
    }
}