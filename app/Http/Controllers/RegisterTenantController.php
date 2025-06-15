<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class RegisterTenantController extends Controller
{
    public function sign_in(){
        return view('sign_in');
    }
}
