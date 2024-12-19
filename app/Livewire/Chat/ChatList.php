<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\WhatsappBusinessProfile;

class ChatList extends Component
{
    public $phone_profile_id;
    public $conversations_contacts = [];

    public function mount()
    {

    }

    #[On('conversations-list')]
    public function loadConversations($phone_profile_id)
    {
        $this->conversations_contacts = [];

        $phone_profile = WhatsappBusinessProfile::find($phone_profile_id);

        // Cargar las conversaciones asociadas al número de teléfono seleccionado
        $conversations = $phone_profile->phoneNumber->messages->groupBy('message_from');

        $contacts = $conversations->map(function ($messages) {
            return $messages->first()->contact;
        });
        
        $this->conversations_contacts = $contacts;
    }

    public function render()
    {
        return view('livewire.chat.chat-list');
    }
}
