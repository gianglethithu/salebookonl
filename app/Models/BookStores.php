<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStores extends Model
{
    use HasFactory;
    protected $fillable = ['store_id','book_id', 'number_in_stock'];
}
