<?php

namespace App\Livewire;

use Livewire\Component;

class Conversations extends Component
{
    public $perfil = 'Conversations new';

    public function render()
    {
        return view('livewire.conversations');
    }
}
