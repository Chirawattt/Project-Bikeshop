@extends('layouts.master')
@section('title', 'อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง, และอุปกรณ์ตกแต่ง')

@section('content')
<h1 class="text-center">รายการสั่งซื้อ</h1>
<div class="breadcrumb">
    <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
    <li class="active">รายการสั่งซื้อ</li>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div style="display: flex; justify-content: space-between; place-items: center">
            <div class="panel-title"><strong>รายการสั่งซื้อ</strong></div>
        </div>
    </div>
    <table class="table table-bordered bs_table" style="font-size: 15px">
        <thead>
            <tr>
                <th class="bs_center">OrderID</th>
                <th class="bs_center">เลขที่ใบสั่งซื้อ</th>
                <th class="bs_center">ชื่อลูกค้า</th>
                <th class="bs_center">วันที่สั่งซื้อสินค้า</th>
                <th class="bs_center">รายละเอียด</th>
                <th class="bs_center">สถานะการชําระเงิน</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $e)
                <tr class="bs_center">
                    <td>{{ Str::padLeft(intval($e->id),3,'0') }}</td>
                    <td>{{ $e->order_number }}</td>
                    <td>{{ $e->customer_name }}</td>
                    <td>{{ substr($e->created_at,0,10) }}</td>
                    <td><a href="{{ URL::to('/order/'.$e->order_number) }}">รายละเอียด</a></td>
                    @if($e->payment_status == 1)
                        <td style="color: rgb(0, 212, 46); font-weight: 400;">ชําระเงินแล้ว</td>
                    @else
                        <td style="color: rgb(238, 0, 0); font-weight: 400;">ยังไม่ชำระเงิน</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="panel-footer" style="text-align: center">
        แสดงข้อมูลจำนวน {{ count($order) }} รายการ
    </div>
</div>
<div class="text-center">
    {{ $order->links() }}
</div>
@endsection