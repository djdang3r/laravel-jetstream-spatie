<?php

namespace App\Livewire\Whatsapp;

use Livewire\Component;
use App\Models\WhatsappBusinessAccount;

class AddBusinessAccount extends Component
{
    public $waba_id;
    public $waba_api_token;
    public $accounts;

    protected $rules = [
        'waba_id' => 'required|string|unique:whatsapp_business_accounts,whatsapp_business_id',
        'waba_api_token' => 'required|string',
    ];

    public function save()
    {
        
        $this->validate();

        WhatsappBusinessAccount::create([
            'whatsapp_business_id' => $this->waba_id,
            'api_token' => $this->waba_api_token,
        ]);

        session()->flash('message', 'Account successfully registered.');

        // Reset form fields
        $this->reset(['waba_id', 'waba_api_token']);
    }

    public function render()
    {
        return view('livewire.whatsapp.add-business-account');
    }
}
