<?php

namespace App\Livewire\Whatsapp;

use Livewire\Component;
use App\Models\WhatsappPhoneNumber;
use App\Models\WhatsappBusinessAccount;
use App\Models\WhatsappBusinessProfile;
use App\Models\Conversation;
use App\Http\Controllers\WhatsappAPICLoudController;


class WhatsappAccounts extends Component
{
    public $accounts;
    public $phoneNumbers = [];
    public $selectedProfile = null;
    public $conversations = [];

    public function mount()
    {
        $this->accounts = WhatsappBusinessAccount::all();

        foreach ($this->accounts as $account) {
            $controller = new WhatsappAPICLoudController();
            $response = $controller->getPhoneNumbers($account->whatsapp_business_id);

            // dd($account->phoneNumbers[0]->businessProfile);

            if ($response->status() == 200) {
                $this->phoneNumbers[$account->whatsapp_business_id] = $response->getData();
            }
        }
    }

    public function selectProfile($profile)
    {
        $phone_profile = WhatsappBusinessProfile::find($profile["whatsapp_business_profile_id"]);
        $this->selectedProfile = $phone_profile;

        // Cargar las conversaciones asociadas al número de teléfono seleccionado
        $conversations = $phone_profile->phoneNumber->messages->groupBy('message_from'); 

        $this->dispatch("conversations-list");
    }

    public function render()
    {
        return view('livewire.whatsapp.whatsapp-accounts');
    }
}
