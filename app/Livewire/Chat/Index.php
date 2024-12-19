<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class Index extends Component
{
    public $conversations = [];

    protected $listeners = ['loadConversations'];

    public function loadConversations($conversations)
    {
        $this->conversations = $conversations;
    }
    
    public function render()
    {
        return view('livewire.chat.index');
    }
}
