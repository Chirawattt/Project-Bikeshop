@extends('layouts.master')
@section('title')
    เพิ่มข้อมูลผู้ใช้
@endsection
@section('content')
    <h1 class="text-center">เพิ่มผู้ใช้ใหม่</h1>
    <ul class="breadcrumb">
        <li><a href="/user">หน้าแรก</a></li>
        <li class="active">เพิ่มผู้ใช้ใหม่</li>
    </ul>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    {!! Form::open([
        'method' => 'POST',
        'enctype' => 'multipart/form-data',
        'action' => 'App\Http\Controllers\UserController@insert',
    ]) !!}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>ข้อมูลผู้ใช้</strong>
            </div>
        </div>
        <div class="panel-body">
            <table class="col-xs-10">
                <tr>
                    <td class="text-right">{{ Form::label('name', 'ชื่อผู้ใช้ :') }}</td>
                    <td>{{ Form::text('name', old('name'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('email', 'อีเมล :') }}</td>
                    <td>{{ Form::text('email', old('email'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('level', 'ระดับผู้ใช้ :') }}</td>
                    <td>{{ Form::select('level', $userLevels, old('level'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('password', 'รหัสผ่าน :') }}</td>
                    <td>{{ Form::text('password', old('password'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('password_confirmation', 'ยืนยันรหัสผ่าน :') }}</td>
                    <td>{{ Form::text('password_confirmation', old('password_confirmation'), ['class' => 'form-control']) }}</td>
                </tr>
                             
            </table> 
        </div>
        <div class="panel-footer">
            <div style="display:flex; justify-content: space-between">
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
