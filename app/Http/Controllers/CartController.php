<?php
//comment for more information
//comment for more information
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    // hello world test test test
    public function viewCart() {
        $cart_items = Session::get('cart_items');
        if(is_null($cart_items)) {
            $cart_items = [];
        }
        return view('cart/index', compact('cart_items'));
    }

    public function addToCart($id) {
        $product = Product::find($id);

        // Use Session::get() to get the cart_items from the session storage if it exists
        // if it's not exists then returen null and assign $cart_items to an empty array
        $cart_items = Session::get('cart_items');
        if(is_null($cart_items)) {
            $cart_items = [];
        }

        $qty = 0;
        // array_key_exists is a function that checks if a key exists in an array
        // for pull previous qty of the product if it exists
        if( array_key_exists($product->id, $cart_items)) {
            $qty = $cart_items[$product->id]['qty'];
        }

        // store the product in the cart_items array([product_id] => product)
        $cart_items[$product['id']] = [
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'image_url' => $product->image_url,
            'qty' => $qty + 1,
        ];

        // Use Session::put() to store the cart_items in the session storage
        // so that it can be accessed in the next request
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function deleteCart($id) {
        $cart_items = Session::get('cart_items');
        unset($cart_items[$id]); // unset is a function that removes a key from an array
        Session::put('cart_items', $cart_items);
        return redirect('cart/view'); 
    }

    public function updateCart($id, $qty) {
        $cart_items = Session::get('cart_items');
        $cart_items[$id]['qty'] = $qty;
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function checkout() {
        if(Session::get('cart_items')) {
            $cart_items = Session::get('cart_items');
            return view('cart/checkout', compact('cart_items'));
        } else {
            return redirect('/cart/view');
        }
    }

    public function complete(Request $request) {
        $cart_items = Session::get('cart_items');
        $cust_name = $request->input('cust_name');
        $cust_email = $request->input('cust_email');
        $po_no = 'PO'.date("Ymd");
        $po_date = date("Y-m-d H:i:s");
        $total_amount = 0;

        $datauser = [$cust_name,$cust_email];
        Session::put('datauser',$datauser);

        foreach($cart_items as $c) { $total_amount += ($c['price'] * $c['qty']);}

        //count order
        $order = Order::latest()->first();
        if (is_null($order)) {
            $po_no = $po_no."0001";
        }
        else {
            $firstnumber = substr($order->order_number, 0, 10);
            $lastnumber = substr($order->order_number, -4);
            $last4number = substr($order->order_number, -4);

            if ($order->order_number == $po_no.$last4number) {
                $count_ = Str::padLeft(intval($lastnumber) + 1, 4, '0');
                $po_no = $firstnumber.$count_;
            }
            else{
                $po_no = $po_no."0001";
            }
        }

        $html_output = view('cart/complete', compact('cart_items', 'cust_name', 'cust_email', 'po_no', 'po_date', 'total_amount'))->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output('output.pdf', "I");

        return response()->withHeader("Content-type", "application/pdf");
    }

    public function finish_order() {
        return redirect('/order/sendorder');
    }
}
