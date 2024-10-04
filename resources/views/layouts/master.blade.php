<!DOCTYPE html>
<html lang="en" ng-app="app">
{{-- use ng-app in html tag to enable the ng-app entirely app --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BikeShop | @yield('title', 'จำหน่ายจักรยานออนไลน์')</title>
    {{-- css --}}
    {{-- public/vendor -> bootstrap, font-awesome, toastr --}}
    {{-- downloaded it to use in this project --}}
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

    {{-- define angular module to use entirely app --}}
    <script>
        // angular.module('name', [dependencies]) -> create module [] means no dependencies create module from scratch
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
            <p class="navbar-text navbar-left">นายจีรวัฒน์ ญานะ 6506021611017</p>
            <div id="navbar" class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav">

                    @guest
                    <li><a href="/home">หน้าแรก</a></li>
                    <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                    <li><a href="{{ route('register')}}">ลงทะเบียน</a></li>
                    @else
                    <li><a href="/cart/view"> 
                        <i class="fa fa-shopping-cart"></i> ตะกร้า
                        <span class="label label-danger">
                            @if (Session::has('cart_items'))
                                {{ count(Session::get('cart_items')) }}
                            @else
                                {{ count([])}}
                            @endif
                        </span>
                    </a></li>
                    <li><a href="#">{{ Auth::user()->name }}</a></li>
                    <li><a href="/product">ข้อมูลสินค้า</a></li>
                    <li><a href="/category">ประเภทสินค้า</a></li>
                    <li><a href="/order">รายการสั่งซื้อ</a></li>
                    <li><a href="/logout">ออกจากระบบ</a></li>@endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    {{-- js --}}
    @if (session('message'))
        @if (session('status'))
            <script>
                toastr.success("{{ session('message') }}")
            </script>
        @else
            <script>
                toastr.error("{{ session('message') }}")
            </script>
        @endif
    @endif
</body>

</html>
