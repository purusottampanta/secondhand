<?php

namespace App\Http\Controllers\Auth\Social;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();   
    }   

    public function callback($provider, SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);

        auth()->login($user);

        return redirect()->intended('/');
    }
}