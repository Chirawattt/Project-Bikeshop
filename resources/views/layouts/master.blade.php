<!DOCTYPE html>
<html lang="en" ng-app="app">
{{-- use ng-app in html tag to enable the ng-app entirely app --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BikeShop | @yield('title', 'จำหน่ายจักรยานออนไลน์')</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css') }}">
    {{-- js --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <script src="{{ asset('https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js') }}"></script>

    {{-- Define Angular module --}}
    <script>
        const app = angular.module('app', []).config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/home" class="navbar-brand">BikeShop</a>
            </div>
            {{-- <p class="navbar-text navbar-left">นายจีรวัฒน์ ญานะ 6506021611017</p> --}}
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    @auth
                    @if (auth()->user()->level == 'admin')
                            <li><a href="/product">หน้าแรก</a></li>
                            <li><a href="/product">ข้อมูลสินค้า</a></li>
                            <li><a href="/category">ข้อมูลประเภทสินค้า</a></li>
                            <li><a href="/user">ข้อมูลผู้ใช้</a></li>
                        @elseif (auth()->user()->level == 'employee')
                            <li><a href="/product">หน้าแรก</a></li>
                            <li><a href="/product">ข้อมูลสินค้า</a></li>
                            <li><a href="/category">ข้อมูลประเภทสินค้า</a></li>
                            <li><a href="/order">ข้อมูลการสั่งซื้อสินค้า</a></li>
                        @elseif (auth()->user()->level == 'customer')
                            <li><a href="/home">หน้าแรก</a></li>
                            <li><a href="/product">ข้อมูลสินค้า</a></li>
                        @endif
                    @endauth
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                        <li><a href="{{ route('register') }}">ลงทะเบียน</a></li>
                    @endguest

                    @auth
                    @if (auth()->user()->level == 'customer')
                        <li>
                            <a href="/cart/view">
                                <i class="fa fa-shopping-cart"></i> ตะกร้า
                                <span class="label label-danger">
                                    @if (Session::has('cart_items'))
                                        {{ count(Session::get('cart_items')) }}
                                    @else
                                        {{ count([]) }}
                                    @endif
                                </span>
                            </a>
                        </li>
                    @endif
                        <li><a href="#">{{ Auth::user()->name }}</a></li>
                        <li><a href="/logout">ออกจากระบบ</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    {{-- JS for Toastr notifications --}}
    @if (session('message'))
        <script>
            toastr.{{ session('status') ? 'success' : 'error' }}("{{ session('message') }}");
        </script>
    @endif
</body>

</html>
