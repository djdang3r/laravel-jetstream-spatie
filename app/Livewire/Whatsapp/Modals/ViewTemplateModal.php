<?php

namespace App\Livewire\Whatsapp\Modals;

use Livewire\Component;
use App\Models\Template;
use App\Http\Controllers\WhatsappAPICLoudController;
use Livewire\Attributes\On;

class ViewTemplateModal extends Component
{

    public $template_id;
    public $template;
    public $template_html;

    public $showModal = false;

    #[On('detail-template')]
    public function viewDetailsTemplate($template)
    {
        // dd($template);
        $this->template = $template;
        $this->template_html = WhatsappAPICLoudController::renderWhatsAppTemplate($template['json'], $template['template_id'], $template['wa_template_id']);
    }

    public function mount()
    {

    }

    public function render()
    {
        // dd($this->template);
        return view('livewire.whatsapp.modals.view-template-modal');
    }
}
