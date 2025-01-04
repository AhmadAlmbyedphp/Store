<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    public function index()
    {
      $products=Product::with('category')
       ->active()->latest()->take(8)->get();
     $catgories = Category::with('products')
       ->latest()->take(6)->get();
      return view('front.home',compact('products','catgories'));
    }
}
