<?php

namespace App\Http\Controllers;

use App\Exports\GroupSaleExport;
use App\Jobs\ExportJob;
use App\Models\Employees;
use App\Models\Groups;
use App\Models\Orders;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel ;

class SaleController extends Controller
{
    public function EmployeeSale()
    {
        $sales = Orders::selectRaw('employee_id, sum(total_cost) as sale')->join('employees','orders.employee_id', '=','employees.id')->groupBy('employees.id')->get();
        foreach($sales as $sale){
            $e_sale = $sale->sale;
            Employees::where('id', $sale->employee_id)->update(['sale'=>$e_sale]);
        }
    }

    public function GroupSale()
    {
        $sales = Employees::selectRaw('group_id, sum(sale) as group_sale')->join('groups', 'employees.group_id', '=', 'groups.id')->groupBy('groups.id')->get();
        foreach($sales as $sale){
            $g_sale = $sale->group_sale;
            Groups::where('id', $sale->group_id)->update(['total_sales'=>$g_sale]);
        }
    }

    public function export()
    {
        return Excel::download(new GroupSaleExport, 'sale.xlsx');
    }

}
