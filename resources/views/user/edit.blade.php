@extends('layouts.master')
@section('title')
    แก้ไขข้อมูลผู้ใช้
@endsection
@section('content')
    <h1 class="text-center">แก้ไขผู้ใช้</h1>
    <ul class="breadcrumb">
        <li><a href="/user">หน้าแรก</a></li>
        <li class="active">แก้ไขผู้ใช้</li>
    </ul>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    {!! Form::model($user, [
        'method' => 'POST',
        'enctype' => 'multipart/form-data',
        'action' => 'App\Http\Controllers\UserController@update',
        // 'url' => '/product/update',
    ]) !!}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>ข้อมูลผู้ใช้</strong>
            </div>
        </div>
        <div class="panel-body">
            <table class="col-xs-10">
                @if($user)
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <tr>
                        <td class="text-right">{{ Form::label('name', 'ชื่อผู้ใช้ :') }}</td>
                        <td>{{ Form::text('name', $user->name, ['class' => 'form-control']) }}</td>
                    </tr>
                @else
                    <p>ไม่พบข้อมูลผู้ใช้</p>
                @endif
                <tr>
                    <td class="text-right">{{ Form::label('email', 'อีเมล :') }}</td>
                    <td>{{ Form::text('email', $user->email, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('level', 'ระดับผู้ใช้ :') }}</td>
                    <td>{{ Form::select('level', $userLevels, $user->level, ['class' => 'form-control']) }}</td>
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