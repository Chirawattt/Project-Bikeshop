<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Detail;

class OrderDetailController extends Controller {
    public function index() {
        $cart_items = Session::get('cart_items');
        if(is_null($cart_items)) {
            $cart_items = [];
        }
        return view('order/orderDetail', compact('cart_items'));
    }
}
