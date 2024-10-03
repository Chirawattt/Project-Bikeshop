<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;

class OrderController extends Controller
{
    public function index() {
        return view('order/order');
    }
}
