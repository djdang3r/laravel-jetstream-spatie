<?php

namespace App\Livewire\Whatsapp;

use Livewire\Component;

class Contacts extends Component
{
    public $phone_profile_id;

    public $contacts = [];

    public function render()
    {
        return view('livewire.whatsapp.contacts');
    }
}
