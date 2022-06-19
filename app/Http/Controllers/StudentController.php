<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.appointment-lists');
    }

    public function create()
    {
        return view('students.new-appointment');
    }
}
