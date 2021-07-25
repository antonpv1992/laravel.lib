<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }



    /**
     * Create a new controller instance.
     *
     * @return
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('home');
            } else {
                $newUser = User::create([
                    'login' => $user->nickname,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => $user->password,
                    'name' => $user->name,
                ]);
                $user->attachRole('user');
                Auth::login($newUser);
                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
