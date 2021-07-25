<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class CustomAuthController extends Controller
{

    public function registration(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255|',
            'age' => 'required|integer|max:255|',
        ]);

        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'surname' => $request->surname,
            'age' => $request->age,
        ]);

        event(new Registered($user));

        $user->attachRole('user');

        Auth::login($user);

        return redirect()->route('verification.notice');
    }


    public function verification(Request $request)
    {
        $content = 'components/verification';
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended('home')
                    : view('welcome', compact('content'));
    }


    public function reverification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('home');
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }


    public function markverification(EmailVerificationRequest $request)
    {
        $request->fulfill();

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home', ['verified' => 1]);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('home', ['verified' => 1]);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function remember(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    public function forgot(Request $request)
    {
        $content = 'components/reset';
        return view('welcome', compact('content', 'request'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('home')
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    function relog()
    {
        return redirect()->route('home');
    }

}