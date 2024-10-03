<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;
// paginate import

class ProductController extends Controller
{
    // rp = Result per page
    // default value is 10
    var $rp = 10;


    public function __construct()
    {
        // get congif from app.php
        $this->rp = Config::get('app.result_per_page');
        $this->middleware('auth');

    }

    public function index()
    {
        $products = Product::paginate($this->rp);
        // $products = DB::table('products')->get();
        return view('product/index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->q;
        if ($query) {
            $products = Product::where('code', 'like', "%$query%")
                ->orWhere('name', 'like', "%$query%")->paginate($this->rp);
            return view('product/index', compact('products'));
        } else {
            $products = Product::paginate($this->rp);
            return redirect()->back()->with('status', false)->with('message', 'โปรดกรอกคำค้นหา');
        }
    }

    public function edit($id = null)
    {
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', ''); // ใช้ pluck('value', 'key') สร้าง array ที่มี key และ value จากข้อมูลในตาราง
        if ($id) { // edit view
            $product = Product::find($id);
            // prepend คือการเพิ่มค่าเข้าไปที่ตำแหน่งแรกของ array
            // result is ['' => 'เลือกรายการ', 1 => 'เสื้อ', 2 => 'กางเกง', 3 => 'รองเท้า']
            return view('product/edit', compact('product', 'categories'));
        } else { // add view
            return view('product/add', compact('categories'));
        }
    }

    public function update(Request $request)
    {
        $rule = ['code' => 'required', 'name' => 'required', 'category_id' => 'required|numeric', 'stock_qty' => 'required|numeric', 'price' => 'required|numeric'];
        $message = ['required' => 'โปรดกรอกข้อมูล :attribute ให้ครบ ', 'numeric' => 'โปรดกรอกข้อมูล :attribute เป็นตัวเลข'];
        $attributes = ['code' => 'รหัสสินค้า', 'name' => 'ชื่อสินค้า', 'category_id' => 'ประเภทสินค้า', 'price' => 'ราคาขายต่อหน่วย', 'stock_qty' => 'จำนวนสินค้าในสต็อก'];
        $id = $request->id;
        $temp = ['code' => $request->code, 'name' => $request->name, 'category_id' => $request->category_id, 'price' => $request->price, 'stock_qty' => $request->stock_qty];
        $validator = Validator::make($temp, $rule, $message, $attributes);
        if ($validator->fails()) {
            return redirect('/product/edit/' . $id)->withErrors($validator)->withInput();
            // return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $product = Product::find($id);
            $product->code = $request->code;
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->stock_qty = $request->stock_qty;
            $product->save();

            if ($request->hasFile('image')) {
                $f = $request->file('image');
                $upload_to = 'upload/images';

                // get path
                $relative_path = $upload_to . '/' . $f->getClientOriginalName();
                $absolute_path = public_path() . '/' . $upload_to;

                // upload file
                $f->move($absolute_path, $f->getClientOriginalName());

                // save image path to database
                $product->image_url = $relative_path;
                $product->save();
            }

            return redirect('/product')->with('status', true)->with('message', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
        }
    }

    public function insert(Request $request)
    {
        $rule = ['code' => 'required|max:10', 'name' => 'required|max:50', 'category_id' => 'required|numeric', 'stock_qty' => 'required|numeric', 'price' => 'required|numeric'];
        $message = ['required' => 'โปรดกรอกข้อมูล :attribute', 'numeric' => 'โปรดกรอกข้อมูล :attribute เป็นตัวเลข', 'max' => 'โปรดกรอกข้อมูล :attribute ไม่เกิน :max ตัวอักษร'];
        $attributes = ['code' => 'รหัสสินค้า', 'name' => 'ชื่อสินค้า', 'category_id' => 'ประเภทสินค้า', 'price' => 'ราคาขายต่อหน่วย', 'stock_qty' => 'จำนวนสินค้าในสต็อก'];
        $temp = ['code' => $request->code, 'name' => $request->name, 'category_id' => $request->category_id, 'price' => $request->price, 'stock_qty' => $request->stock_qty];
        $validator = Validator::make($temp, $rule, $message, $attributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $product = new Product();
            $product->code = $request->code;
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->stock_qty = $request->stock_qty;
            $product->save();

            if ($request->hasFile('image')) {
                $f = $request->file('image');
                $upload_to = 'upload/images';

                // get path
                $relative_path = $upload_to . '/' . $f->getClientOriginalName();
                $absolute_path = public_path() . '/' . $upload_to;

                // upload file
                $f->move($absolute_path, $f->getClientOriginalName());

                // save image path to database
                $product->image_url = $relative_path;
                $product->save();
            }
            return redirect('/product')->with('status', true)->with('message', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
        }
    }

    public function remove($id)
    {
        Product::find($id)->delete();
        return redirect('/product')->with('status', true)->with('message', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
