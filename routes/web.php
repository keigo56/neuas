<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student/appointment-lists', function () {
    return view('students.appointment-lists');
})->name('student.appointment-lists');

Route::get('/student/my-account', function () {
    return view('students.my-account');
})->name('student.my-account');

Route::get('/student/new-appointment-1', function () {
    return view('students.new-appointment');
})->name('student.new-appointment');

Route::get('/student/new-appointment-2', function () {
    return view('students.new-appointment-2');
})->name('student.new-appointment-2');

Route::get('/student/new-appointment-3', function () {
    return view('students.new-appointment-3');
})->name('student.new-appointment-3');
