<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Order_Detail;

class OrderDetailController extends Controller {
    public function displayDetail($order_number) {
        $order = Order::where('order_number', $order_number)->first();
        if (!$order) {
            return redirect()->back()->with('status', false)->with('message', 'ควยไรสัส');
        }
        $orderDetails = Order_Detail::where('order_id', $order->id)->get();
        return view('order/orderDetail', compact('order', 'orderDetails'));
    }
    
    public function createOrderDetail($order_id) {
        $cart_items = Session::get('cart_items');
        foreach($cart_items as $i) {
            $orderDetail = new Order_Detail();
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $i['id'];
            $orderDetail->amount = $i['qty'];
            $orderDetail->save();
        }
        Session::remove('cart_items');
        return redirect('/home')->with('status', true)->with('message', 'สั่งซื้อสินค้าสำเร็จ');
    }

    public function updatePaymentStatus(Request $request) {
        $order_id = $request->input('order_id');
        $payment_status = $request->input('payment_status');
        $order = Order::find($order_id);
        if (!$order) {
            return redirect()->back()->with('status', false)->with('message', 'ไม่พบสินค้า');
        }
        $order->payment_status = $payment_status;
        $order->save();
        return redirect('/order')->with('status', true)->with('message', 'อัพเดทข้อมูลการชำระเงิน');
    }
}
