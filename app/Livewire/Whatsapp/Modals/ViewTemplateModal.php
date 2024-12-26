<?php

namespace App\Livewire\Whatsapp\Modals;

use Livewire\Component;

class ViewTemplateModal extends Component
{
    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.whatsapp.modals.view-template-modal');
    }
}
