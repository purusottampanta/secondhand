<?php

namespace App\Listeners\Product;

use App\Events\Product\ProductViewCounter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cookie;

class ProductViewCounterListener
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
     * @param  ProductViewCounter  $event
     * @return void
     */
    public function handle(ProductViewCounter $event)
    {
        Cookie::queue(Cookie::make('product_view'.$event->product->id, $event->product->product_slug, '5'));

        if(Cookie::get('product_view'.$event->product->id) !== $event->product->product_slug){
            $event->product->increment('views');
        }
        
    }
}
