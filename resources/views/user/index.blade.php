@extends('layouts.master')
@section('title')
    ข้อมูลผู้ใช้ทั้งหมด
@endsection
@section('content')
    <h1 class="text-center">ข้อมูลผู้ใช้ทั้งหมด</h1>
    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าแรก</a></li>
        <li class="active">ข้อมูลผู้ใช้</li>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; place-items: center">
                <div class="panel-title"><strong>รายการ</strong></div>
                <a href="/user/edit" class="btn btn-success" style="padding: 8px 16px;">เพิ่มผู้ใช้</a>
            </div>
        </div>
        <div class="panel-body">
            {{-- search from --}}
            <form action="/user/search" method="POST" class="form-group">
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
                    <th>วันที่สร้าง</th>
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
                        <td> {{ $user->created_at}} </td>
                        <td> {{ $user->level}} </td>
                        <td class="bs_center">
                            <a href="/user/edit/{{ $user->id }}" class="btn btn-info"><i class="fa fa-edit"></i>
                                แก้ไข</a>
                            {{-- <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $user->id }}"><i
                                    class="fa fa-trash"></i> ลบ</a> --}}

                            <a href="/user/remove/{{ $user->id }}" class="btn btn-danger btn-delete"
                                onclick="return confirm('คุณต้องการลบข้อมูลผู้ใช้ {{ $user->name }} ใช่หรือไม่')">
                                <i class="fa fa-trash"></i> ลบ</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-footer text-center">
            แสดงข้อมูลจำนวน {{ count($users) }} รายการ
        </div>
        <div class="text-center">
            {{ $users->links() }}
        </div>
    
        {{-- <script>
            // jQuery technique
            $('.btn-delete').on('click', function() {
                if (confirm('คุณต้องการลบข้อมูลใช่หรือไม่?')) {
                    var url = "{{ URL::to('user/remove') }}" +
                        "/" + $(this).attr('id-delete');
                    window.location.href = url;
                }
            })
        </script> --}}
    @endsection
    {{-- test  --}}
    
