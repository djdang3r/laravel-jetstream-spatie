<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Message;
use App\Models\WhatsappBusinessProfile;
use App\Http\Controllers\WhatsappChatController;
use Carbon\Carbon;

class ChatBox extends Component
{
    public $whatsapp_phone;
    public $contact;
    public $messages = [];
    public $messageContent;

    #[On('view-messages')]
    public function viewMessages($contact, $profile_id)
    {
        $this->contact = $contact;
        $this->messages = [];
        $whatsapp_profile = WhatsappBusinessProfile::find($profile_id);
        $this->whatsapp_phone = $whatsapp_profile->phoneNumber;
        $contactPhoneNumber = $contact['country_code'] . $contact['phone_number'];

        // Obtener los mensajes no leídos y actualizarlos
        Message::where(function ($query) use ($contactPhoneNumber) {
            $query->where('message_from', $contactPhoneNumber);
        })->where('whatsapp_phone_id', $this->whatsapp_phone->whatsapp_phone_id)
          ->whereNull('readed_at')->where('message_method', 'INPUT')
          ->update(['readed_at' => Carbon::now()]);

        // Obtener todos los mensajes
        $this->messages = Message::where(function ($query) use ($contactPhoneNumber) {
            $query->where('message_from', $contactPhoneNumber)
                  ->orWhere('message_to', $contactPhoneNumber);
        })->where('whatsapp_phone_id', $this->whatsapp_phone->whatsapp_phone_id)
          ->orderBy('created_at', 'asc')
          ->get();

    }

    public function sendMessage()
    {
        $data = [
            'celular' => $this->contact['country_code'] . $this->contact['phone_number'],
            'tipo' => 'OUTPUT',
            'type' => 'TEXT',
            'mensaje' => $this->messageContent,
            'phone_number_id' => $this->whatsapp_phone->whatsapp_phone_id,
        ];

        $request = new \Illuminate\Http\Request();
        $request->replace($data);

        $controller = new WhatsappChatController();
        $response = $controller->sendMessage($request);

        $this->viewMessages($this->contact, $this->whatsapp_phone->whatsapp_business_profile_id);
        $this->messageContent = '';
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
