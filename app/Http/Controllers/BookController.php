<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\BookStores;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function NumberStock()
    {
        $books = BookStores::select('*')->get();
        foreach($books as $book){
            $number_stock = $book->number_in_stock;
            $book_id = $book->book_id;
            Books::where('id', $book_id)->update(['number_stock'=>$number_stock]);
        }
    }

    public function NumberSold()
    {
        $books = OrderItems::selectRaw('book_id, sum(quantity) as sold')->groupBy('book_id')->get();
        foreach($books as $book){
            Books::where('id', $book->book_id)->update(['number_sold'=> $book->sold]);
        }
    }
}
