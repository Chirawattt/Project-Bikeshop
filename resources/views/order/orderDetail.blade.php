@extends('layouts.master')
@section('title', 'อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง, และอุปกรณ์ตกแต่ง')

@section('content')
<h1 class="text-center">รายละเอียดการสั่งซื้อ</h1>
<div class="breadcrumb">
    <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
    <li><a href="{{ URL::to('/order')}}">คำสั่งซื้อ</a></li>
    <li class="active">รายละเอียดการสั่งซื้อ  {{$order->order_number}}</li>
</div>

<div class="panel panel-primary">
    <input type="hidden" id="order_id" value="{{$order->id}}">
    <input type="hidden" id="order_number" value="{{$order->order_number}}">
    <div class="panel-heading">
        <div class="panel-title"><strong>รายละเอียดการสั่งซื้อ</strong></div>
    </div>
    <table class="table table-bordered bs_table" style="font-size: 15px; border-bottom: 1px solid rgb(226, 226, 226);">
        <thead>
            <tr>
                <th>เลขที่ใบสั่งซื้อ</th>
                <th>ชื่อลูกค้า</th>
                <th>อีเมล์</th>
                <th>วันที่สั่งซื้อสินค้า</th>
                <th>สถานะการชำระเงิน</th>
            </tr>
        </thead>
        <tbody>
            <td style="width: 20%">{{$order->order_number}}</td>
            <td style="width: 20%">{{$order->customer_name}}</td>
            <td style="width: 20%">{{$order->customer_email}}</td>
            {{-- <td style="width: 20%">{{ $order->created_at->format('Y/m/d H:i:s') }}</td> --}}
            <td style="width: 20%">{{ $order->created_at->format('Y/m/d') }}</td>
            <td style="width: 20%">
                <input onchange="test()" type="checkbox" id="payment_status" @if($order->payment_status) checked @endif>
            </td>
        </tbody>
    </table>
    <br>
    <table class="table table-bordered bs_table" style="font-size: 15px; border-top: 1px solid rgb(226, 226, 226);">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อสินค้า</th>
                <th class="bs_price">ราคาต่อหน่วย</th>
                <th class="bs_price">จำนวน</th>
                <th class="bs_price">รวมเงิน</th>
            </tr>
        </thead>
        <tbody>
            <?php $sum_price = 0 ?>
            <?php $sum_qty = 0 ?>
            @foreach ($orderDetails as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->product->name}}</td>
                    <td class="bs_price">{{ number_format($item->product->price, 0)}}</td>
                    <td class="bs_price">{{$item->amount}}</td>
                    <td class="bs_price">{{ number_format($item->product->price * $item->amount, 0)}}</td>
                </tr>
                <?php $sum_price += ($item->product->price * $item->amount ) ?>
                <?php $sum_qty += $item->amount ?>
            @endforeach
            <tfoot>
                <tr>
                    <th></th>
                    <th colspan="2">รวม</th>
                    <th class="bs_price">{{number_format($sum_qty, 0)}}</th>
                    <th class="bs_price">{{number_format($sum_price, 2)}}</th>
                </tr>
            </tfoot>
        </tbody>
    </table>
    <div class="panel-footer"></div>
</div>

<script>
    $(function() {
        // config 
        $('#payment_status').bootstrapToggle({
        on: 'ชำระเงินแล้ว',
        off: 'ยังไม่ชำระเงิน',
        onstyle: 'success',
        offstyle: 'danger'
        });
    })

    function test() {
        try {
            let payment = $('#payment_status').is(':checked') ? 1 : 0;
            
            $.ajax({
                url: "{{ URL::to('/order/updatepayment') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}", // เพิ่ม CSRF token
                    order_id: $('#order_id').val(),
                    payment_status: payment,
                    order_number: $('#order_number').val()
                },
                success: function(response) {
                    console.log('Payment status updated successfully');
                },
                error: function(xhr) {
                    console.log('Error updating payment status');
                }
            });
        } catch(err) {
            console.log(err);
        }
    }

</script>
@endsection