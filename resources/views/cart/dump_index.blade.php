@extends('layouts.master')
@section('title', 'ตะกร้าสินค้า')
@section('content')

    <div class="container">
        <h1 class="text-center">สินค้าในตะกร้า</h1>
        <div class="breadcrumb">
            <li><a href="{{ URL::to('home')}}"><i class="fa fa-home"> หน้าร้าน</i></a></li>
            <li class="active">สินค้าในตะกร้า</li>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>รวม</th>
                            <th>การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart_items as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <input type="number" value="{{ $item['qty'] }}" min="1" max="100" onchange="updateCart({{ $item['id'] }}, this.value)">
                                </td>
                                <td>{{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger" onclick="removeFromCart({{ $item['id'] }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        
                        @endforeach
                        {{-- <tr ng-repeat="item in cart_items">
                            <td>@{ item.id }</td>
                            <td>@{ item.name }</td>
                            <td>@{ item.price | number:2 }</td>
                            <td>
                                <input type="number" ng-model="item.qty" ng-change="updateCart(item)">
                            </td>
                            <td>@{ item.price * item.qty | number:2 }</td>
                            <td>
                                <button class="btn btn-danger" ng-click="removeFromCart(item)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>  --}}
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>สรุปรายการสินค้า</h4>
                    </div>
                    <div class="panel-body">
                        <p>จำนวนสินค้า: <strong>@{ cart.length }</strong> รายการ</p>
                        <p>ราคารวม: <strong>@{ total | number:2 }</strong> บาท</p>
                    </div>
                    <div class="panel-footer">
                        <a href="/checkout" class="btn btn-success btn-block">สั่งซื้อสินค้า</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection