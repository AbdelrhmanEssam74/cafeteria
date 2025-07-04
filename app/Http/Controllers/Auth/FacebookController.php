<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            $user = User::where('email', $facebookUser->email)->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'password' => bcrypt(rand(100000, 999999)), // كلمة مرور عشوائية
                    'facebook_id' => $facebookUser->id,
                ]);
            }
            
            Auth::login($user);
            return redirect()->route('/user/home'); // عدل حسب مسارك
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to login with Facebook');
        }
    }
}