<?php

namespace App\Jobs;

use App\Exports\GroupSaleExport;
use App\Models\Orders;
use Illuminate\Bus\Queueable;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
           $date = new DateTime();
            $oneDayPeriod = new DateInterval('P1D');
            $date->sub($oneDayPeriod);
            // dd($date);
            $orders = Orders::where('orders.created_at','>',$date)->selectRaw('group_id, sum(cost_amount) as e_sale')->join('employees', 'orders.employee_id', '=', 'employees.id')->groupBy('group_id')->get();

        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
