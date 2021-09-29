<?php

namespace App\Listeners;

use App\Events\OrderSucceed;
use App\Events\UpdateEmployeeSale;
use App\Models\Employees;
use App\Models\Orders;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatedEmployeeSale implements ShouldQueue
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
        // dd($order_id);
        $order = Orders::where('id',$order_id)->first();
        $employee = Employees::where('id',$order->employee_id)->first();
        $sale = $employee->sale + $order->cost_amount;
        $employee->sale = $sale;
        $employee->save();
    }
}
