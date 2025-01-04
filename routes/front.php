<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;
use App\Http\Controllers\Front\ProdcutsControllert;
use Illuminate\Support\Facades\Route;

Route::get('/products',[ProdcutsControllert::class,'index'])
    ->name('products.index');

Route::get('/products/{product:slug}',[ProdcutsControllert::class,'shew'])
      ->name('products.shew');

Route::resource('cart', CartController::class);

Route::get('checkout',[CheckoutController::class,'create'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'store']);

Route::get('auth/user/2fa',[TwoFactorAuthentcationController::class,'index'])->name('front.2fa');
