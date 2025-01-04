<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class DeductProductQuntity
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        // استخدمت try في حال نفذت كمية quantity

       $order = $event->order;
       try{
            foreach($order->products as $product){
                $product->decrement('quantity',$product->order_item->quantity);
            }
        } catch(Throwable $e){

        }
    }


}
