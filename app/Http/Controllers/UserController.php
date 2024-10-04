<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Config; 

class UserController extends Controller
{
    var $rp = 10;


    public function __construct()
    {
        // get congif from app.php
        $this->rp = Config::get('app.result_per_page');
        $this->middleware('auth');

    }

    public function index(){
        $users = User::paginate($this->rp); // ดึงข้อมูลผู้ใช้และแบ่งหน้า
        return view('user.index', compact('users')); // ใช้ '.' แทน '/'
    }


    public function search(Request $request)
    {
        $query = $request->q;
        if ($query) {
            $users = User::where('code', 'like', "%$query%")
                ->orWhere('name', 'like', "%$query%")->paginate($this->rp);
            return view('user/index', compact('products'));
        } else {
            $users = User::paginate($this->rp);
            return redirect()->back()->with('status', false)->with('message', 'โปรดกรอกคำค้นหา');
        }
    }

    public function edit($id = null)
    {
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', ''); // ใช้ pluck('value', 'key') สร้าง array ที่มี key และ value จากข้อมูลในตาราง
        if ($id) { // edit view
            $users = User::find($id);
            // prepend คือการเพิ่มค่าเข้าไปที่ตำแหน่งแรกของ array
            // result is ['' => 'เลือกรายการ', 1 => 'เสื้อ', 2 => 'กางเกง', 3 => 'รองเท้า']
            return view('product/edit', compact('product', 'categories'));
        } else { // add view
            return view('product/add', compact('categories'));
        }
    }
}
