<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $fillable = [ 'full_name', 'email', 'password', 'group_id'];

    public function order()
    {
        return $this->hasMany(Orders::class);
    }
}
