<?php

namespace App\Listeners;

use App\Events\OrderSucceed;
use App\Models\Employees;
use App\Models\Groups;
use App\Models\Orders;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateGroupSale implements ShouldQueue
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
        // sleep(5);
        $order_id = $event->order_id;
        $order = Orders::where('id',$order_id)->first();
        $employee = Employees::where('id',$order->employee_id)->first();
        $group = Groups::where('id', $employee->group_id)->first();
        // $total_sale = $group->total_sales +
        $group->total_sales += $order->cost_amount;
        $group->save();
    }
}
