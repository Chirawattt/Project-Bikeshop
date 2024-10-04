<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        $order = Order::paginate(5);

        return view('order/order',compact('order'));
    }
    
    public function sendorder(Request $request) {
        $datauser = Session::get('datauser');

        $cust_name = $request->input('cust_name');
        $cust_email = $request->input('cust_email');
        $po_no = 'PO'.date("Ymd");
        $po_date = date("Y-m-d H:i:s");

        $order = new Order();
        $order->customer_name = $datauser[0];
        $order->customer_email = $datauser[1];

        $allorder = Order::latest()->first();

        if (is_null($allorder))  {
            $order->order_number = $po_no."0001";
        }
        else {
            $firstnumber = substr($allorder->order_number, 0, 10);
            $lastnumber = substr($allorder->order_number, -4);
            $last4number = substr($allorder->order_number, -4);

            if ($allorder->order_number == $po_no.$last4number) {
                $count_ = Str::padLeft(intval($lastnumber) + 1, 4, '0');

                $order->order_number = $firstnumber.$count_;
            }
            else{
                $order->order_number = $po_no."0001";
            }
        }

        $order->payment_status = false;
        $order->save();

        $datauser = Session::get('datauser');
        Session::remove('datauser');

        return redirect('/');
    }
}
