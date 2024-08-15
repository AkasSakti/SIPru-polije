<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $findUser = User::where('google_id', $user->id)->first();

        if($findUser){
            Auth::login($findUser);
            return redirect('/home');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
                'avatar' => $user->avatar,
                'email_verified_at' => now(),
                'password' => encrypt('123456dummy'),
                'keterangan' => 'mahasiswa', // Default sebagai mahasiswa
            ]);

            Auth::login($newUser);
            return redirect('/home');
        }
    }
}