<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Validator;
use App\Models\SocialCustomers;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('home');
            } else {
                $findEmail = User::where('email', $user->email)->first();
                if ($findEmail) {
                    $findEmail->email = $user->email;
                    $findEmail->facebook_id = $user->id;
                    $findEmail->save();
                    Auth::login($findEmail);
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->id,
                        'password' => encrypt('123456dummy')
                    ]);
                    Auth::login($newUser);
                }
                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('home');
            } else {
                $findEmail = User::where('email', $user->email)->first();
                if ($findEmail) {
                    $findEmail->email = $user->email;
                    $findEmail->google_id = $user->id;
                    $findEmail->save();
                    Auth::login($findEmail);
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt('123456dummy')
                    ]);
                    Auth::login($newUser);
                }
                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
