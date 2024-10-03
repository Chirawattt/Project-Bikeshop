@extends('layouts.master')
@section('title', 'อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง, และอุปกรณ์ตกแต่ง')

@section('content')
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
                                <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)"><i
                                        class="fa fa-shopping-cart">
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
@endsection
