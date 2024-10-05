<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ตรวจสอบว่ามีผู้ใช้เข้าสู่ระบบหรือไม่
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == 'admin' || $user->level == 'employee') {
                return redirect('/product');
            } else {
                return view('home');
            }
        } else {
            // ถ้าไม่ได้เข้าสู่ระบบ ให้เปลี่ยนเส้นทางไปที่หน้า login
            return view('home');
        }
    }

    public function logout() {
        request()->session()->flush();
        Auth::logout();
        return redirect('/login');
    }
    
}
