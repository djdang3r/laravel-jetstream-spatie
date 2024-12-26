<?php

namespace App\Livewire\Whatsapp;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Template;
use App\Models\WhatsappBusinessProfile;
use App\Http\Controllers\WhatsappChatController;
use App\Http\Controllers\WhatsappAPICLoudController;

class Templates extends Component
{
    public $phone_profile_id;
    public $templates = [];
    public $selectedProfile = null;

    protected $listeners = ['echo:receive_message, MessageReceived' => 'onMessageReceived'];

    public function mount()
    {

    }

    public function onMessageReceived($payload)
    {
        // Maneja el evento aquí
        // Puedes agregar lógica para actualizar los mensajes o cualquier otra cosa
        dd($payload);
    }

    #[On('conversations-list')]
    public function loadTemplates($phone_profile_id)
    {

        $this->phone_profile_id = $phone_profile_id;
        $this->tenplates = [];

        $phone_profile = WhatsappBusinessProfile::find($phone_profile_id);

        $controller = new WhatsappAPICLoudController();
        $response = $controller->getTemplates($phone_profile);

        $templates = Template::where('whatsapp_business_id', $phone_profile->phoneNumber->businessAccount->whatsapp_business_id)->get();

        $this->templates = $templates;

    }

    public function render()
    {
        return view('livewire.whatsapp.templates');
    }
}
