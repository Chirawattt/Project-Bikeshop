<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductControllerApi extends Controller
{
    //
    public function product_list($category_id = null)
    {
        if ($category_id) {
            $products = Product::where('category_id', $category_id)->get();
        } else {
            $products = Product::all();
        }
        return response()->json(['ok' => true, 'products' => $products]);
    }

    public function product_search(Request $request)
    {
        $query = $request->get('query');
        $category_id = $request->get('category_id');
        if ($category_id) {
            if ($query) $products = Product::where('name', 'like', "%$query%")->where('category_id', $category_id)->get();
            else $products = Product::where('category_id', $category_id)->get();
        } else {
            if ($query) $products = Product::where('name', 'like', "%$query%")->get();
            else $products = Product::all();
        }
        return response()->json(['ok' => true, 'products' => $products]);
    }
}
