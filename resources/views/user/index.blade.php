@extends('layouts.master')
@section('title')
    รายการชื่อ user
@endsection
@section('content')
    <h1 class="text-center">รายชื่อ user ทั้งหมด</h1>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; place-items: center">
                <div class="panel-title"><strong>รายการ</strong></div>
                <a href="#" class="btn btn-success" style="padding: 8px 16px;">เพิ่มสินค้า</a>
            </div>
        </div>
        <div class="panel-body">
            {{-- search from --}}
            <form action="#" method="POST" class="form-group">
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
                    <th>รหัส</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>อีเมล</th>
                    <th>level</th>
                    <th>หน้าที่</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        
                        <td> {{ $user->id }} </td>
                        <td> {{ $user->name }} </td>
                        <td> {{ $user->email}} </td>
                        <td> {{ $user->level}} </td>
                        <td class="bs_center">
                            <a href="/product/edit/{{ $user->id }}" class="btn btn-info"><i class="fa fa-edit"></i>
                                แก้ไข</a>
                            {{-- <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $user->id }}"><i
                                    class="fa fa-trash"></i> ลบ</a> --}}

                            <a href="/product/remove/{{ $user->id }}" class="btn btn-danger btn-delete"
                                onclick="return confirm('คุณต้องการลบข้อมูลสินค้า {{ $user->name }} ใช่หรือไม่')">
                                <i class="fa fa-trash"></i> ลบ</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <div class="panel-footer text-center">
                        แสดงข้อมูลจำนวน {{ count($users) }} รายการ
                    </div>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">
            {{ $users->links() }}
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
    
