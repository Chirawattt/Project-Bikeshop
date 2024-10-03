@extends('layouts.master')
@section('title', 'อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง, และอุปกรณ์ตกแต่ง')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">{{ __('Dashboard') }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="row" ng-controller="ctrl">
        <div class="col-md-3">
            <h2 class="text-center">สินค้าในร้าน</h2>
            <div class="list-group" style="cursor: pointer">
                <a class="list-group-item" ng-class="{'active': category == null }" ng-click="getProductList(null)">ทั้งหมด</a>
                
                <a class="list-group-item" ng-repeat="c in categories" ng-click="getProductList(c)"
                    ng-class="{'active': category.id == c.id }">@{c.name}</a>
            </div>
        </div>
        <div class="col-md-9">
            <div style="margin-top: 63px; margin-bottom: 20px">
                <input type="text" class="form-control" ng-model="query" ng-keyup="searchProduct($event)"
                    placeholder="พิมพ์ชื่อสินค้าเพื่อค้นหา . . .">
            </div>
            <div class="row">
                <div class="col-md-3" ng-repeat="p in products">
                    {{-- product card --}}
                    <div class="panel panel-default bs-product-card">
                        <img ng-src="@{p.image_url}" class="img-responsive">
                        <div class="panel-body">
                            <h5><a href="#" title="@{p.name}">@{p.name.length > 40 ? (p.name|limitTo:35) + '...' :
                                    p.name}</a></h5>
                            <div class="form-group">
                                <div>คงเหลือ: @{p.stock_qty}</div>
                                <div>ราคา <strong>@{p.price|number:2}</strong> บาท</div>
                            </div>
                            @guest
                            @else
                            <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)"><i class="fa fa-shopping-cart">
                                    หยิบใส่ตะกร้า</i></a>
                            @endguest
                        </div>
                    </div>
                    {{-- ^ end product card --}}
                </div>
                <div class="alert alert-danger" role="alert" ng-if="!products.length"> ไม่พบข้อมูลสินค้า </div>
            </div>
        </div>
    </div>

    <script>
        app.service('productService', function($http) {
            this.getProductList = function(category_id) {
                if (category_id) {
                    return $http.get('/api/product/' + category_id);
                }
                return $http.get('/api/product');
            }
            this.getCategoryList = function() {
                return $http.get('/api/category');
            }
            this.searchProduct = function(query) {
                return $http.post('/api/product/search', {
                    query: query,
                    category_id: category_id
                });
            }
            
        });
        // controller
        app.controller('ctrl', function($scope, productService) {
            $scope.helloMessage = 'ยินดีต้อนรับสู่ AngularJS และ Laravel';

            $scope.products = [];
            $scope.category = {};

            // getProductList function of controller 
            $scope.getProductList = function(category) {
                $scope.category = category;
                category_id = category != null ? category.id : '';
                // if category is not null then get category id

                // use getProductList function from productService service to fetch data from api
                productService.getProductList(category_id).then(function(res) {
                    if (!res.data.ok) {
                        alert('เกิดข้อผิดพลาด');
                        return;
                    }
                    $scope.products = res.data.products;
                });
                $scope.query = '';
            }
            
            $scope.getCategoryList = function() {
                productService.getCategoryList().then(function(res) {
                    if (!res.data.ok) {
                        alert('เกิดข้อผิดพลาด');
                        return;
                    }
                    $scope.categories = res.data.categories;
                })
            }
            $scope.searchProduct = function(e) {
                productService.searchProduct($scope.query).then(function(res) {
                    if (!res.data.ok) {
                        alert('เกิดข้อผิดพลาด');
                        return;
                    }
                    $scope.products = res.data.products;
                    console.log($scope.products);
                    
                })
            }
            $scope.addToCart = function(p) {
                window.location.href = '/cart/add/' + p.id;
            }

            $scope.getProductList(null);
            // call function to get product list initially by passing null to get all products first

            $scope.getCategoryList(); // call function to get category list
        });
    </script>



    {{-- original before optimize --}}
    {{-- <div class="container" ng-app="app" ng-controller="ctrl">
        <h2 class="text-center">@{ helloMessage }</h2>
        <input type="text" class="form-control" ng-model="helloMessage">
        <br>
        <br>
        <br>
        <input type="text" class="form-control" ng-model="query.name" placeholder="ค้นหาสินค้า . . .">
        <table class="table table-bordered" ng-if="products.length">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคาขาย</th>
                    <th>คงเหลือ</th>
                    <th class="text-center">สถานะ</th>
                </tr>
            </thead>
            <tr ng-repeat="p in products|filter:query">
                <td>@{p.code}</td>
                <td>@{p.name}</td>
                <td>@{p.price|number:2}</td>
                <td>@{p.stock_qty|number:0}</td>
                <td align="center">
                    <span ng-if="p.stock_qty > 0 && p.stock_qty < 5" class="label label-warning">สินค้าใกล้หมด</span>
                    <span ng-if="p.stock_qty == 0" class="label label-danger">สินค้าหมด</span>
                    {{-- another way by using ng-class --}}
    {{-- <span ng-if="p.qty > 0 && p.qty < 5" ng-class="{'label label-warning': p.qty > 0 && p.qty < 5}">สินค้าใกล้หมด</span> --}}
    {{-- <span ng-if="p.qty == 0" ng-class="{'label label-danger': p.qty == 0}">สินค้าหมด</span>
                    
                </td>
            </tr>
        </table>
        <div class="alert alert-danger" role="alert" ng-if="!products.length"> ไม่พบข้อมูลสินค้า </div>
    </div>
 --}}
@endsection