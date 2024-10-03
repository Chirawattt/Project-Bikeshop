@extends('layouts.master')
@section('title')
    เพิ่มข้อมูลสินค้า
@endsection
@section('content')
    <h1 class="text-center">เพิ่มสินค้า</h1>
    <ul class="breadcrumb">
        <li><a href="/product">หน้าแรก</a></li>
        <li class="active">เพิ่มสินค้า</li>
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
        'action' => 'App\Http\Controllers\ProductController@insert',
        // 'url' => '/product/insert',
    ]) !!}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>เพิ่มข้อมูลสินค้า</strong>
            </div>
        </div>
        <div class="panel-body">
            <table class="col-xs-10">
                <tr style="gap: 20px;">
                    <td class="text-right">
                        {{ Form::label('code', 'รหัสสินค้า :', ['class' => 'text']) }}</td>
                    <td> {{ Form::text('code', Request::old('code'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('name', 'ชื่อสินค้า :') }}</td>
                    <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('category_id', 'ประเภทสินค้า :') }}
                    </td>
                    <td>{{ Form::select('category_id', $categories, Request::old('category_id'), ['class' => 'form-control']) }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        {{ Form::label('stock_qty', 'จำนวนสินค้าในสต็อก :') }}</td>
                    <td>{{ Form::text('stock_qty', Request::old('stock_qty'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('price', 'ราคาขายต่อหน่วย :') }}</td>
                    <td>{{ Form::text('price', Request::old('price'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('image', 'เลือกรูปภาพสินค้า :') }}
                    </td>
                    <td>{{ Form::file('image') }}</td>
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
