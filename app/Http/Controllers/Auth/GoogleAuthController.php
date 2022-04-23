<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(){

        $user = Socialite::driver('google')->user();

        if(!$user){
            return redirect()->route('login');
        }

        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();

        // DOMAIN VALIDATION
        if(!str($email)->contains('@gmail.com')){
            session()->flash('google.auth.failed');
            return redirect()->route('login');
        }

        $user_exists = User::query()->where('email', $email)->exists();

        if($user_exists){

            $user = User::query()->where('email', $email)->first();

            $user->update([
                'name' => $name,
                'avatar' => $avatar,
            ]);

        }else{

            $user = User::query()->create([
                'name' => $name,
                'email' => $email,
                'avatar' => $avatar,
            ]);

            $user->assignRole('student');
        }

        Auth::login($user);

        request()->session()->regenerate();

        return RouteServiceProvider::redirectByRole();
    }
}
