<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsappChatController extends Controller
{
    public function whatsappIndex()
    {
        $apiUrl = config('services.whatsapp.api_url');
        $apiVersion = config('services.whatsapp.api_version');
        $apiToken = config('services.whatsapp.api_token');

        dd($apiUrl, $apiVersion, $apiToken);
        return view('whatsapp_chat.index');
    }
}
