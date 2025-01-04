<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;


 class ProdcutsControllert extends Controller
{
    public function index()
    {

    }
    public function shew(Product $product)
    {
        if($product->status !='active'){
            abort(404);
        }
        return view('front.products.shew',compact('product'));
      
    }
}
