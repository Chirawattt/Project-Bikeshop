@extends('layouts.master')
@section('title')
    รายการประเภทสินค้า
@endsection
@section('content')
    <h1 class="text-center">ประเภทสินค้าทั้งหมด</h1>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; place-items: center">
                <div class="panel-title"><strong>ประเภทสินค้า</strong></div>
                <a href="/category/edit" class="btn btn-success" style="padding: 8px 16px;">เพิ่มประเภทสินค้า</a>
            </div>
        </div>
        <div class="panel-body">
            {{-- search from --}}
            <form action="/category/search" method="POST" class="form-group">
                @csrf
                <div class="col-xs-10">
                    <input type="text" name="q" class="form-control" placeholder="ค้นหาสิ่งที่ต้องการ . . .">
                </div>
                <button type="submit" class="btn btn-primary col-xs-2">ค้นหา</button>
                @error('queryError')
                    <script>
                        toastr.error(@json($message), 'เกิดข้อผิดพลาด');
                    </script>
                @enderror
            </form>
        </div>
        <table class="table table-bordered bs_table">
            <thead>
                <tr class="tr-th-center">
                    <th>รหัส</th>
                    <th>ชื่อประเภท</th>
                    <th>การทำงาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr class="tr-td-center">
                        <td> {{ $item->id }} </td>
                        <td> {{ $item->name }} </td>
                        <td class="bs_center">
                            <a href="/category/edit/{{ $item->id }}" class="btn btn-info"><i class="fa fa-edit"></i>
                                แก้ไข</a>
                            <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $item->id }}"><i
                                    class="fa fa-trash"></i> ลบ</a>

                            {{-- <a href="/category/remove/{{ $item->id }}" class="btn btn-danger btn-delete"
                                onclick="return confirm('คุณต้องการลบข้อมูลสินค้า {{ $item->name }} ใช่หรือไม่')">
                                <i class="fa fa-trash"></i> ลบ</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-footer text-center">
            แสดงข้อมูลจำนวน {{ count($categories) }} รายการ
        </div>
    </div>
    <div class="text-center">
        {{ $categories->links() }}
    </div>

    <script>
        // jQuery technique
        $('.btn-delete').on('click', function() {
            if (confirm('คุณต้องการลบประเภทใช่หรือไม่?')) {
                var url = "{{ URL::to('category/remove') }}" +
                    "/" + $(this).attr('id-delete');
                window.location.href = url;
            }
        })
    </script>
@endsection
