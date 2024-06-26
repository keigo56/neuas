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
    return redirect()->route('login');
});

//Route::get('/email', function () {
//    return view('emails.appointment');
//});

Route::middleware(['guest'])->group(function(){
    Route::get('/google/auth/redirect', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirect'])->name('google.auth');
    Route::get('/google/auth/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'callback'])->name('google.callback');
});

Route::middleware(['auth'])->group(function(){
    Route::middleware(['role:student'])->group(function(){

        Route::get('/student/new-appointment', [\App\Http\Controllers\StudentController::class, 'create'])->name('student.new-appointment');
        Route::get('/student/appointment-lists', [\App\Http\Controllers\StudentController::class, 'index'])->name('student.appointment-lists');

    });

    Route::middleware(['role:registrar', 'ensureRightDepartment'])->group(function(){
        Route::prefix('/{department:slug}/registrar')->group(function(){
            Route::get('/', [\App\Http\Controllers\RegistrarController::class, 'dashboard'])->name('registrar.dashboard');
            Route::get('/appointments', [\App\Http\Controllers\RegistrarController::class, 'appointments'])->name('registrar.appointments');
            Route::get('/users', [\App\Http\Controllers\RegistrarController::class, 'users'])->name('registrar.users');
            Route::get('/settings', [\App\Http\Controllers\RegistrarController::class, 'settings'])->name('registrar.settings');
        });
    });

    Route::middleware(['role:guard'])->group(function(){
        Route::get('/guard', function () {
            return view('guards.index');
        })->name('guard.index');
    });
});

require __DIR__.'/auth.php';
