<?php

namespace App\Exports;

use App\Models\Employees;
use App\Models\Groups;
use App\Models\Orders;
use DateInterval;
use DateTime;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GroupSaleExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $date = new DateTime();
        $oneDayPeriod = new DateInterval('P1D');
        $date->sub($oneDayPeriod);
        // dd($date);
        $orders = Orders::where('orders.created_at','>',$date)->selectRaw('group_id, sum(cost_amount) as e_sale')->join('employees', 'orders.employee_id', '=', 'employees.id')->groupBy('group_id')->get();
        // dd($orders);
        return $orders;
    }

    public function headings(): array
    {
        return [
           'group_id',
           'sale'
        ];
    }
}
