<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


 class ProdcutsControllert extends Controller
{
    public function index()
    {
        $request= request();
        $products= Product::filter($request->query())->paginate(6);
        $categories = Category::paginate(6);
        return view('front.products.index',compact('products','categories'));
    }
    public function shew(Product $product)
    {
        if($product->status !='active'){
           return view('front.404');
        }
        return view('front.products.shew',compact('product'));

    }
}
