<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    // rp = Result per page
    // default value is 10
    var $rp = 5;

    public function __construct()
    {
        // get congif from app.php
        // $this->rp = Config::get('app.result_per_page');
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::paginate($this->rp);
        return view('category/index', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->q;
        if ($query) {
            $categories = Category::where('id', 'like', "%$query%")
                ->orWhere('name', 'like', "%$query%")->paginate($this->rp);
            return view('category/index', compact('categories'));
        } else {
            $categories = Category::paginate($this->rp);
            return redirect()->back()->with('status', false)->with('message', 'โปรดกรอกคำค้นหา');
        }
    }

    public function edit($id = null)
    {
        if ($id) { // edit view
            $category = Category::find($id);
            return view('category/edit', compact('category'));
        } else { // add view
            return view('category/add');
        }
    }

    public function update(Request $request)
    {
        $rule = ['name' => 'required|min:5'];
        $message = ['required' => 'โปรดกรอกข้อมูล :attribute ให้ครบ ', 'min' => 'โปรดกรอกข้อมูล :attribute อย่างน้อย :min ตัวอักษร'];
        $attributes = ['name' => 'ประเภทสินค้า'];
        $id = $request->id;
        $temp = ['name' => $request->name];
        $validator = Validator::make($temp, $rule, $message, $attributes);
        if ($validator->fails()) {
            return redirect('/category/edit/' . $id)->withErrors($validator)->withInput();
            // return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();

            return redirect('/category')->with('status', true)->with('message', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
        }
    }

    public function insert(Request $request)
    {
        $rule = ['name' => 'required|min:5'];
        $message = ['required' => 'โปรดกรอกข้อมูล :attribute ให้ครบ ', 'min' => 'โปรดกรอกข้อมูล :attribute อย่างน้อย :min ตัวอักษร'];
        $attributes = ['name' => 'ประเภทสินค้า'];
        $temp = ['name' => $request->name];
        $validator = Validator::make($temp, $rule, $message, $attributes);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            return redirect('/category')->with('status', true)->with('message', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
        }
    }

    public function remove($id)
    {
        Category::find($id)->delete();
        return redirect('/category')->with('status', true)->with('message', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
