<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On; 

class ChatList extends Component
{
    public $conversations = [];

    #[On('conversations-list')] 
    public function loadConversations()
    { 
        
        dd($this->conversations);

    }

    public function render()
    {
        return view('livewire.chat.chat-list');
    }
}
