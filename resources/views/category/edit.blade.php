@extends('layouts.master')
@section('title')
    แก้ไขประเภทสินค้า
@endsection
@section('content')
    <h1 class="text-center">แก้ไขประเภทสินค้า</h1>
    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าแรก</a></li>
        <li><a href="{{ URL::to('category') }}">ข้อมูลประเภทสินค้า</a></li>
        <li class="active">แก้ไขประเภทสินค้า</li>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    {!! Form::model($category, [
        'method' => 'POST',
        'enctype' => 'multipart/form-data',
        'action' => 'App\Http\Controllers\CategoryController@update',
        // 'url' => '/product/update',
    ]) !!}
    <input type="hidden" name="id" value="{{ $category->id }}">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>ข้อมูลประเภทสินค้า</strong>
            </div>
        </div>
        <div class="panel-body">
            <table class="col-xs-12">
                <tr>
                    <td class="text-right col-xs-2">{{ Form::label('name', 'ชื่อประเภท :') }}</td>
                    <td>{{ Form::text('name', $category->name, ['class' => 'form-control']) }}</td>
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
