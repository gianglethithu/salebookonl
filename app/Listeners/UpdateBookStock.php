<?php

namespace App\Listeners;

use App\Events\OrderSucceed;
use App\Models\Books;
use App\Models\OrderItems;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBookStock implements ShouldQueue
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
     * @param  OrderSucceed  $event
     * @return void
     */
    public function handle(OrderSucceed $event)
    {
        $order_id = $event->order_id;
        $orderItems = OrderItems::where('order_id', $order_id)->get();
        foreach($orderItems as $orderItem){
            $book = Books::where('id', $orderItem->book_id)->first();
            $book->number_sold += $orderItem->quantity;
            $book->number_stock -= $orderItem->quantity;
            $book->save();
        }
    }
}
