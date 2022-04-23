<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarController extends Controller
{
    public function dashboard()
    {
        return view('registrars.index');
    }

    public function appointments()
    {
        return view('registrars.appointments');
    }

    public function users()
    {
        return view('registrars.users');
    }

    public function settings()
    {
        return view('registrars.settings');
    }
}
