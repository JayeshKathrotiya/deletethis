<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Validation extends Controller
{
    public function validLogin()
    {
        return request()->validate([
            'email' => ['required' ,'email'],
            'password' => ['required'],
        ]);
    }
}
