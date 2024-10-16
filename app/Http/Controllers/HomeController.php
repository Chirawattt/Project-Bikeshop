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
    public function index() {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     if ($user->level == 'admin' || $user->level == 'employee') {
        //         return redirect('/product');
        //     } else {
        //         return view('home');
        //     }
        // } else {
        //     return view('home');
        // }

        return view('home');
    }

    public function logout() {
        request()->session()->flush();
        Auth::logout();
        return redirect('/login');
    }
    
}
