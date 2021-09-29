<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'title', 'avatar', 'publisher_id', 'price'];

    public function order_item()
    {
        return $this->hasMany(OrderItems::class);
    }
}
