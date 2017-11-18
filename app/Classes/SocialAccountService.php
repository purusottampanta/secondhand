<?php

namespace App\Classes;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;
use App\Models\User;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                // $user = User::create([
                //     'email' => $providerUser->getEmail(),
                //     'name' => $providerUser->getName(),
                // ]);
                
                $user = new User;

                $user->email = $providerUser->getEmail();
                $user->full_name = $providerUser->getName();
                $user->confirmed = 1;
                $user->api_token = str_random(60);  
                $user->password = bcrypt(str_random());

                $user->save();
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}