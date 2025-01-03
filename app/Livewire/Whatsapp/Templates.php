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
    public $template_id = '';
    public $template = '';
    public $templates = [];
    public $selectedProfile = null;

    public $showViewModal = false;
    public $modal_delete_template = false;

    public function mount()
    {

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

    public function selectTemplate($template_id)
    {
        $template = Template::find($template_id);
        $this->template_id = $template_id;
        $this->template = $template;

        $this->dispatch("detail-template", template: $template);
    }

    public function viewTemplate()
    {
        $this->showViewModal = true;
    }

    public function delteTemplate( $template_id )
    {
        $this->modal_delete_template = true;
    }

    public function render()
    {
        return view('livewire.whatsapp.templates');
    }
}
