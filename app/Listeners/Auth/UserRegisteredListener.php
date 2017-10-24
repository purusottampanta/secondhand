<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Auth\EmailVerificationMail;

class UserRegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        \Mail::to($event->user->email, $event->user->full_name)->send(new EmailVerificationMail($event->user));
    }
}
