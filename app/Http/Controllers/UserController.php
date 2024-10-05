<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Config; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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


    public function search(Request $request){
        $query = $request->input('q');  
        if (!empty($query)) {
            $users = User::where('id', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->paginate($this->rp);
            if ($users->isEmpty()) {
                return view('user/index', compact('users'))->with('message', 'ไม่พบผู้ใช้ที่ค้นหา');
            }
            return view('user/index', compact('users'));
        } else {
            return redirect()->back()->with('status', false)->with('message', 'โปรดกรอกคำค้นหา');
        }
    }



    public function edit($id = null){
        // ตรวจสอบว่ามี id ที่ส่งเข้ามาหรือไม่
        if ($id) { 
            $user = User::find($id);  // ค้นหาผู้ใช้จาก ID
            
            // ตรวจสอบว่าพบผู้ใช้หรือไม่
            if (!$user) {
                return redirect('/user')->with('status', false)->with('message', 'ไม่พบข้อมูลผู้ใช้');
            }

            $userLevels = ['admin' => 'Admin', 'employee' => 'Employee', 'customer' => 'Customer'];  // ตัวอย่างระดับผู้ใช้
            return view('user/edit', compact('user', 'userLevels'));  // ส่งข้อมูลไปที่ view
        } else { // ถ้าไม่มี ID ให้แสดงหน้าเพิ่มผู้ใช้
            $userLevels = ['admin' => 'Admin', 'employee' => 'Employee', 'customer' => 'Customer'];
            return view('user/add', compact('userLevels'));  // ส่งเฉพาะระดับไปที่ view
        }
    }


    public function update(Request $request){
        $rule = [ 'name' => 'required', 'email' => 'required', 'level' => 'required'];
        $message = ['required' => 'โปรดกรอกข้อมูล :attribute ให้ครบ ', 'numeric' => 'โปรดกรอกข้อมูล :attribute เป็นตัวเลข'];
        $attributes = [ 'name' => 'ชื่อผู้ใช้', 'email' => 'emailผู้ใช้', 'level' => 'ระดับของผู้ใช้'];
        $id = $request->id;
        $temp = [ 'name' => $request->name, 'email' => $request->email, 'level' => $request->level];
        $validator = Validator::make($temp, $rule, $message, $attributes);
        if ($validator->fails()) {
            return redirect('/user/edit/' . $id)->withErrors($validator)->withInput();
            // return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->level = $request->level;
            $user->save();
            return redirect('/user')->with('status', true)->with('message', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
        }
    }

    public function insert(Request $request){
        // กฎการตรวจสอบข้อมูล
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'level' => 'required',
            'password' => 'required|min:8|confirmed',
        ];

        // ข้อความแสดงข้อผิดพลาด
        $messages = [
            'required' => 'โปรดกรอกข้อมูล :attribute ให้ครบ',
            'email' => 'โปรดกรอกอีเมลที่ถูกต้อง',
            'unique' => ':attribute นี้มีอยู่ในระบบแล้ว',
            'min' => ':attribute ต้องมีอย่างน้อย :min ตัวอักษร',
            'confirmed' => 'การยืนยัน :attribute ไม่ตรงกัน',
        ];

        // การตั้งชื่อแทนสำหรับฟิลด์
        $attributes = [
            'name' => 'ชื่อผู้ใช้',
            'email' => 'อีเมล',
            'level' => 'ระดับของผู้ใช้',
            'password' => 'รหัสผ่าน',
        ];

        // เตรียมข้อมูลสำหรับการตรวจสอบ
        $temp = [
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];

        // ทำการตรวจสอบข้อมูล
        $validator = Validator::make($temp, $rules, $messages, $attributes);

        if ($validator->fails()) {
            // กลับไปยังหน้าฟอร์มพร้อมแสดงข้อผิดพลาดและข้อมูลที่กรอกก่อนหน้า
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // สร้างผู้ใช้ใหม่
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->level = $request->level;
            $user->password = Hash::make($request->password); // เข้ารหัสรหัสผ่าน
            $user->save();

            // ส่งผู้ใช้กลับไปยังหน้ารายการผู้ใช้ พร้อมข้อความแจ้งเตือน
            return redirect('/user')->with('status', true)->with('message', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
        }
    }
    public function remove($id)
    {
        User::find($id)->delete();
        return redirect('/user')->with('status', true)->with('message', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
