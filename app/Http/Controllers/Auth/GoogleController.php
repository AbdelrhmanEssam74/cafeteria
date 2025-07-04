<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(Str::random(24)), // كلمة مرور عشوائية
                    'google_id' => $googleUser->getId(),
                ]
            );

            Auth::login($user);

            return redirect('/user/home'); // أو أي صفحة بعد تسجيل الدخول

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['google' => 'Failed to login with Google']);
        }
    }
}
