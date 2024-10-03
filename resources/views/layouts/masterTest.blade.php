<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> BikeShop | @yield('title')</title>

    {{-- public/vendor -> bootstrap, font-awesome, toastr --}}
    {{-- downloaded it to use in this project --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
    <style>
        .main {
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <div class="container">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">หน้าแรก</a></li>
                    <li><a href="#">ข้อมูลสินค้า</a></li>
                    <li><a href="#">รายงาน</a></li>
                </ul>
            </div>
        </nav>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>หัวข้อ</strong>
                </div>
            </div>
            <div class="panel-body">
                content go here
            </div>
            <div class="panel-footer">
                <strong>Footer</strong>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover ">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคาขาย</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td> {{ $item->code }} </td>
                        <td> {{ $item->name }} </td>
                        <td>{{ $item->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Content here --}}
        <div class="row">
            <div class="main col-xs-10 col-xs-offset-1 text-center">
                ทดสอบเนื้อหาของ col-xs-10 col-xs-offset-1
            </div>
        </div>

        <div class="btn">
            <a href="#" class="btn btn-default">Default</a>
            <a href="#" class="btn btn-primary">primary</a>
            <a href="#" class="btn btn-info">info</a>
            <a href="#" class="btn btn-success">success</a>
            <a href="#" class="btn btn-warning">warning</a>
            <a href="#" class="btn btn-danger">danger</a>
        </div>

        <input type="text" class="form-control" placeholder="ชื่อผู้ใช้">
        <input type="password" class="form-control" placeholder="รหัสผ่าน">
        <button class="btn btn-primary">เข้าระบบ</button>

        <div class="form-inline">
            <input type="text" class="form-control" placeholder="ชื่อผู้ใช้">
            <input type="password" class="form-control" placeholder="รหัสผ่าน">
            <button class="btn btn-primary">เข้าระบบ</button>
        </div>

        <div class="form-group">
            <label>ชื่อ-นามสกุล</label>
            <input type="text" class="form-control">
            <div class="help-block">กรุณากรอกชื่อ-นามสกุล</div>
        </div>
        <div class="form-group">
            <label>ที่อยู่</label>
            <textarea rows="4" class="form-control"></textarea>
            <div class="help-block">กรุณากรอกที่อยู่</div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">เพิ่มข้อมูล</button>
        </div>

        <div class="alert-box">
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                <strong><i class="fa-solid fa-check"></i> Success</strong>
                <span>ข้อความสำเร็จ</span>
            </div>
            <div class="alert alert-info alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                <strong><i class="fa-solid fa-info"></i> Info</strong>
                <span>ข้อความแจ้งผู้ใช้งาน</span>
            </div>
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                <strong><i class="fa-solid fa-circle-exclamation"></i> Danger</strong>
                <span>ข้อความแจ้งผู้ใช้งาน</span>
            </div>
        </div>
        <script>
            toastr.success('สำเร็จ');
            toastr.error('ผิดพลาด');
        </script>
    </div>

</body>

</html>
