<?php

namespace App\Http\Controllers;

use App\Events\CreateNewCustomer;
use App\Events\CreateNewOrder;
use App\Events\OrderSucceed;
use App\Models\Books;
use App\Models\Customers;
use App\Models\Employees;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\OrderVouchers;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function OrderItemPrice()
    {
        $order_items = OrderItems::select('*')->get();
        foreach($order_items as $order_item){
            $quantity = $order_item->quantity;
            $book_ = Books::where('id', $order_item->book_id)->first();
            //dd($book);
            $book_price = $book_->price;
            $price = $book_price * $quantity;
            OrderItems::where('id',$order_item->id)->update(['price'=>$price]);
        }
    }

    public function OrderVoucherDiscount()
    {
        $order_vouchers = OrderVouchers::select()->get();
        foreach($order_vouchers as $order_voucher){
            $voucher = Vouchers::where('id', $order_voucher->voucher_id)->first();
            OrderVouchers::where('id', $order_voucher->id)->update(['discount'=>$voucher->discount]);
        }
    }

    public function Order()
    {
        //total_discount
        $order_discounts = Orders::selectRaw('order_id, sum(discount) as total_discount')->join('order_vouchers','orders.id', '=', 'order_vouchers.order_id')->groupBy('orders.id')->get();
        foreach($order_discounts as $order_discount){
            //dd($order_discount);
            $discount = $order_discount->total_discount;
            //dd($discount);
            Orders::where('id', $order_discount->order_id)->update(['total_discount'=>$discount]);
        }
        //cost_amount
        $order_costs = Orders::selectRaw('order_id, sum(price) as cost_amount')->join('order_items','orders.id', '=', 'order_items.order_id')->groupBy('orders.id')->get();
        foreach($order_costs as $order_cost){
            $cost = $order_cost->cost_amount;
            Orders::where('id', $order_cost->order_id)->update(['cost_amount'=>$cost]);
        }
        //total_cost
        $orders = Orders::select()->get();
        foreach($orders as $order){
            $total_discount = $order->total_discount;
            $cost_amount = $order->cost_amount;
            $deliver_cost = $order->deliver_cost;
            $total_cost = $cost_amount + $deliver_cost - $total_discount;
            Orders::where('id', $order->id)->update(['total_cost'=>$total_cost]);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            //dd($request->employee_id);
            //$name = ;
            // $customer = Customers::where(
            //     'name', $request->customer_name
            // 'address' => $request->customer_address,
            // 'phone' => $request->customer_phone,
            // 'credit' => $request->customer_credit
            // )->first();
            $customer = Customers::firstOrCreate([
                'name'=> $request->customer_name,
            ]);
             //dd($customer);
            //dd($request);
            $employee = Employees::findOrFail($request->employee_id);
            //dd($employee->id);

            // $order = Orders::create([
            //     'employee_id' => $employee->id,
            //     'customer_id' => $customer->id,
            //     'deliver_cost' => 15000,
            //     'pay_method' => 'cast',
            //     'cost_amount' => 0
            // ]);
            // dd($order);
            $order = new Orders();
            $order->employee_id = $employee->id;
            $order->customer_id = $customer->id;
            $order->cost_amount = 0;
            $order->deliver_cost = 15000;
            $order->pay_method ='cast';
            $order->total_discount = 0;
            $order->total_cost = 0;
            $order->save();
// dd($order->id);
            $items = $request->items;
// dd($items);
            foreach($items as $item){
                //dd($item["book_id"]);
                $orderItem = new OrderItems();
                $orderItem->order_id = $order->id;
                $orderItem->book_id = $item['book_id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $orderItem->book->price * $orderItem->quantity;
                $orderItem->save();
                // dd($orderItem->price);
                $order->cost_amount += $orderItem->price;
            }
            // dd($order->cost_amount);
            $order->total_cost = $order->cost_amount + $order->deliver_cost;
             $order->save();
            // dd($order->total_cost);
            event(new OrderSucceed($order->id));
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            $e_array = [
                "file" => $e->getFile(),
                "Line" => $e->getLine(),
                "message" => $e->getMessage()
            ];
            return $e_array;
        }
        return response()->json($order);
    }
}
