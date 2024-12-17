<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsappAPICLoudController extends Controller
{
    //
    public function templatesList()
    {
        return view('templates.templates');
    }
}
