<?php

namespace App\Listeners\Auth;

use App\Events\Auth\EmailConfirmed;
use App\Mail\Auth\EmailVerifiedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirmedListener implements ShouldQueue
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
     * @param  EmailConfirmed  $event
     * @return void
     */
    public function handle(EmailConfirmed $event)
    {
        \Mail::to($event->user->email, $event->user->full_name)->send(new EmailVerifiedMail($event->user));
    }
}
