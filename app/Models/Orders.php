<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'customer_id', 'deliver_cost', 'pay_method'];

    public function order_item()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }
}
