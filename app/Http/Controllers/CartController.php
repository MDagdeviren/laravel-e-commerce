<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('lists.cart');
    }
    public function allData($id)
    {
        $data = Product::whereIn("id",explode(",",$id))->get();

        return $data;
    }
}
