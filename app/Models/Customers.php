<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'phone', 'credit'];

    public function order()
    {
        return $this->hasMany(Orders::class);
    }
}
