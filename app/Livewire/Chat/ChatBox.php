<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Message;
use App\Models\WhatsappBusinessProfile;
use Carbon\Carbon;

class ChatBox extends Component
{
    public $whatsapp_phone;
    public $contact;
    public $messages = [];

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

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
