<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class mainController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('layouts.masterTest', compact('products'));
    }
}
