<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Activity;

class OrderObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $order
     * @return void
     */
    public function created(Order $order)
    {
        if(authUser()){
            $order->logs()->create([
                'user_id' => authUser()->id,
                'object' => $order->id,
                'activity' => 'created',
                'ip_address' => request()->getClientIp(),
            ]);
        }else{
           $order->logs()->create([
                'user_id' => 0,
                'object' => $order->id,
                'activity' => 'created',
                'ip_address' => request()->getClientIp(),
            ]); 
        }
        // if(! auth()->check()){
        //     event(new UserRegistered($order));
        // }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $order
     * @return void
     */
    public function deleting(Order $order)
    {
        //
    }

    /**
     * Listen to the user updating event.
     * @param  User   $order 
     * @return void       
     */
    public function updating(Order $order)
    {
        $order->buildLog();
    }
}