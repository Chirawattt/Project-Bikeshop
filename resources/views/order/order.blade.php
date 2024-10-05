@extends('layouts.master')
@section('title', 'อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง, และอุปกรณ์ตกแต่ง')

@section('content')
<h1 class="text-center">รายการสั่งซื้อ</h1>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div style="display: flex; justify-content: space-between; place-items: center">
            <div class="panel-title"><strong>รายการสั่งซื้อ</strong></div>
        </div>
    </div>
    <table class="table table-bordered bs_table">
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
                    <td>
                        @if($e->payment_status == 1)
                            <p style="color:#4ee061;">ชําระเงินแล้ว</p>
                        @endif
                        @if($e->payment_status == 0)
                            <p style="color:#ff0000;">ยังไม่ชําระเงิน</p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>
<div class="text-center">
    {{ $order->links() }}
</div>
@endsection