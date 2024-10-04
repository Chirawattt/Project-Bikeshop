<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Order_Detail;

class OrderDetailController extends Controller {
    public function displayDetail($order_number)
    {
        // ค้นหา Order โดยใช้ order_number
        $order = Order::where('order_number', $order_number)->first();
    
        // ตรวจสอบว่าพบ Order หรือไม่
        if (!$order) {
            return redirect()->back()->with('status', false)->with('message', 'ควยไรสัส');
        }
    
        // ดึงข้อมูล Order_Detail โดยใช้ order_id จาก Order ที่เจอ
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

    public function updatePaymentStatus(Request $request)
    {
        // รับค่าผ่าน POST method
        $order_id = $request->input('order_id');
        $payment_status = $request->input('payment_status');
        $order_number = $request->input('order_number');
    
        // ค้นหา Order
        $order = Order::where('order_number', $order_number)->first();
        if (!$order) {
            return redirect()->back()->with('status', false)->with('message', 'ควยไรสัส 2');
        }
    
        // อัปเดตสถานะการชำระเงิน
        $order->payment_status = $payment_status;
        $order->save();
    
        return redirect()->back()->with('status', true)->with('message', 'ได้แล้วสัส');
    }
    

}
