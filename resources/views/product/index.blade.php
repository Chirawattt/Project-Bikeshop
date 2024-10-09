@extends('layouts.master')
@section('title')
    รายการสินค้า
@endsection
@section('content')
    <h1 class="text-center">รายการสินค้าทั้งหมด</h1>
    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าแรก</a></li>
        <li class="active">ข้อมูลสินค้า</li>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; place-items: center">
                <div class="panel-title"><strong>รายการ</strong></div>
                <a href="/product/edit" class="btn btn-success" style="padding: 8px 16px;">เพิ่มสินค้า</a>
            </div>
        </div>
        <div class="panel-body">
            {{-- search from --}}
            <form action="/product/search" method="POST" class="form-group">
                @csrf
                <div class="col-xs-10">
                    <input type="text" name="q" class="form-control" placeholder="ค้นหาสิ่งที่ต้องการ . . .">
                </div>
                <button type="submit" class="btn btn-primary col-xs-2">ค้นหา</button>
            </form>
        </div>
        <table class="table table-bordered bs_table">
            <thead>
                <tr>
                    <th class="bs_center">รูปสินค้า</th>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภท</th>
                    <th>สาขา</th>
                    <th class="bs_price">คงเหลือ</th>
                    <th class="bs_price">ราคาต่อหน่วย</th>
                    <th class="bs_center">การทำงาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td align="center"> <img src="{{ URL::to($item->image_url) }}" alt="Product Image" width="50px">
                        </td>
                        <td> {{ $item->code }} </td>
                        <td> {{ $item->name }} </td>
                        <td> {{ $item->category->name }} </td>
                        <td> {{ $item->branch != "" ? $item->branch->name:"" }} </td>
                        <td class="bs_price"> {{ number_format($item->stock_qty, 0) }} </td>
                        <td class="bs_price"> {{ number_format($item->price, 2) }} </td>
                        <td class="bs_center">
                            <a href="/product/edit/{{ $item->id }}" class="btn btn-info"><i class="fa fa-edit"></i>
                                แก้ไข</a>

                            <a href="/product/remove/{{ $item->id }}" class="btn btn-danger btn-delete"
                                onclick="return confirm('คุณต้องการลบข้อมูลสินค้า {{ $item->name }} ใช่หรือไม่')">
                                <i class="fa fa-trash"></i> ลบ</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">รวม</th>
                    <th class="bs_price">{{ $products->sum('stock_qty') }}</th>
                    <th class="bs_price">{{ number_format($products->sum('price'), 2) }}</th>
                </tr>
            </tfoot>
        </table>
        <div class="panel-footer text-center">
            แสดงข้อมูลจำนวน {{ count($products) }} รายการ
        </div>
    </div>
    <div class="text-center">
        {{ $products->links() }}
    </div>

    {{-- <script>
        // jQuery technique
        $('.btn-delete').on('click', function() {
            if (confirm('คุณต้องการลบข้อมูลใช่หรือไม่?')) {
                var url = "{{ URL::to('product/remove') }}" +
                    "/" + $(this).attr('id-delete');
                window.location.href = url;
            }
        })
    </script> --}}
@endsection
{{-- test  --}}
