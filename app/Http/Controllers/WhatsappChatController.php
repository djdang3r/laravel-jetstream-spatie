<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsappChatController extends Controller
{
    public function whatsappIndex()
    {
        return view('whatsapp_chat.index');
    }
}
