<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'book_id', 'quantity'];
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
