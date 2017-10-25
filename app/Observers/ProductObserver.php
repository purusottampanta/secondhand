<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Activity;
use App\Events\Auth\UserRegistered;

class ProductObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $product
     * @return void
     */
    public function created(Product $product)
    {
        $product->logs()->create([
            'user_id' => $product->id,
            'object' => $product->product_name,
            'activity' => 'created',
            'ip_address' => request()->getClientIp(),
        ]);

        // if(! auth()->check()){
        //     event(new UserRegistered($product));
        // }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $product
     * @return void
     */
    public function deleting(Product $product)
    {
        //
    }

    /**
     * Listen to the user updating event.
     * @param  User   $product 
     * @return void       
     */
    public function updating(Product $product)
    {
        $product->buildLog();
    }
}