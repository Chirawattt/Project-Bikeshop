@extends('layouts.master')
@section('title')
    แก้ไขข้อมูลสินค้า
@endsection
@section('content')
    <h1 class="text-center">แก้ไขสินค้า</h1>
    <ul class="breadcrumb">
        <li><a href="/product">หน้าแรก</a></li>
        <li class="active">แก้ไขสินค้า</li>
    </ul>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    {!! Form::model($product, [
        'method' => 'POST',
        'enctype' => 'multipart/form-data',
        'action' => 'App\Http\Controllers\ProductController@update',
        // 'url' => '/product/update',
    ]) !!}
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>ข้อมูลสินค้า</strong>
            </div>
        </div>
        <div class="panel-body">
            <table class="col-xs-10">
                @if ($product->image_url)
                    <tr>
                        <td class="text-right"><strong>รูปสินค้า :</strong></td>
                        <td><img src="{{ URL::to($product->image_url) }}" alt="Product Image" width="300px"></td>
                    </tr>
                @endif
                <tr>
                    <td class="text-right">{{ Form::label('code', 'รหัสสินค้า :') }}</td>
                    <td>{{ Form::text('code', $product->code, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('name', 'ชื่อสินค้า :') }}</td>
                    <td>{{ Form::text('name', $product->name, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('category_id', 'ประเภทสินค้า :') }}</td>
                    <td>{{ Form::select('category_id', $categories, Request::old('category_id'), ['class' => 'form-control']) }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('stock_qty', 'จำนวนสินค้าในสต็อก :') }}</td>
                    <td>{{ Form::text('stock_qty', $product->stock_qty, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('price', 'ราคาขายต่อหน่วย :') }}</td>
                    <td>{{ Form::text('price', $product->price, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ Form::label('image', 'เลือกรูปภาพสินค้า :') }}</td>
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
