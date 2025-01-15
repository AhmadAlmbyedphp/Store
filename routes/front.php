<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;
use App\Http\Controllers\Front\ProdcutsControllert;
use App\Http\Controllers\Front\PaymentsController;
use Illuminate\Support\Facades\Route;

Route::get('/products',[ProdcutsControllert::class,'index'])
    ->name('products.index');

Route::get('/products/{product:slug}',[ProdcutsControllert::class,'shew'])
      ->name('products.shew');

Route::resource('cart', CartController::class);

Route::get('checkout',[CheckoutController::class,'create'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'store']);

Route::get('auth/user/2fa',[TwoFactorAuthentcationController::class,'index'])->name('front.2fa');

Route::get('orders/{order}/pay', [PaymentsController::class, 'create'])
    ->name('orders.payments.create');

Route::post('orders/{order}/stripe/paymeny-intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');

Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');
