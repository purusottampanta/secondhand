<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Activity;
use App\Events\Auth\UserRegistered;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->logs()->create([
            'user_id' => $user->id,
            'object' => $user->full_name,
            'activity' => 'created',
            'ip_address' => request()->getClientIp(),
        ]);

        if(! auth()->check()){
            event(new UserRegistered($user));
        }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        //
    }

    /**
     * Listen to the user updating event.
     * @param  User   $user 
     * @return void       
     */
    public function updating(User $user)
    {
        $user->buildLog();
    }
}