<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class RegistrarController extends Controller
{
    public function dashboard(Department $department)
    {
        return view('registrars.index',[
            'department' => $department
        ]);
    }

    public function appointments(Department $department)
    {
        return view('registrars.appointments',[
            'department' => $department
        ]);
    }

    public function users(Department $department)
    {
        return view('registrars.users',[
            'department' => $department
        ]);
    }

    public function settings(Department $department)
    {
        return view('registrars.settings',[
            'department' => $department
        ]);
    }
}
