<?php

namespace App\Livewire\Whatsapp;

use Livewire\Component;
use ScriptDevelop\WhatsappManager\Models\WhatsappPhoneNumber;
use ScriptDevelop\WhatsappManager\Models\WhatsappBusinessAccount;
use ScriptDevelop\WhatsappManager\Models\WhatsappBusinessProfile;
use ScriptDevelop\WhatsappManager\Models\Conversation;
use App\Http\Controllers\WhatsappAPICLoudController;


class WhatsappAccounts extends Component
{
    public $accounts;
    public $phoneNumbers = [];
    public $selectedProfile = null;
    public $selectedBusinessAccount = null;
    public $selectedPhoneNumber = null;
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
        $this->selectedPhoneNumber = $phone_profile->phone_number;
        $this->selectedBusinessAccount = $phone_profile->phoneNumber->businessAccount;

        $this->dispatch("conversations-list", $phone_profile->whatsapp_business_profile_id);
    }

    public function render()
    {
        return view('livewire.whatsapp.whatsapp-accounts');
    }
}
