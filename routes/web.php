<?php

use App\Http\Controllers\Front\Homecontroller;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [Homecontroller::class,'index'])
     ->name('home');


// require __DIR__.'/auth.php';
require __DIR__.'/front.php';
require __DIR__.'/dashboard.php';
