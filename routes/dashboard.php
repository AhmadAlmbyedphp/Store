<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\StoresController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;


// Admim dashboard
Route::middleware('auth:admin,web')
    ->as('dashboard.')
    ->prefix('admin/dashboard')
    ->group(function ()
    {
        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
            //////////////// Category
        Route::get('/categories/trash',[CategoriesController::class,'trash'])
            ->name('categories.trash');
        Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])
            ->name('categories.restore');
        Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])
            ->name('categories.force-delete');
        Route::resource('/categories',CategoriesController::class);
            ///////////////// Product
        Route::get('/products/trash',[ProductsController::class,'trash'])
        ->name('products.trash');
        Route::put('/products/{product}/restore',[ProductsController::class,'restore'])
        ->name('products.restore');
        Route::delete('/products/{product}/force-delete',[ProductsController::class,'forceDelete'])
        ->name('products.force-delete');
        Route::resource('/products',ProductsController::class);
             //////////////Orders
        Route::get('/orders/trash',[OrderController::class,'trash'])
        ->name('orders.trash');
        Route::put('/orders/{order}/restore',[OrderController::class,'restore'])
        ->name('orders.restore');
        Route::delete('/orders/{order}/force-delete',[OrderController::class,'forceDelete'])
        ->name('orders.force-delete');
       Route::resource('/orders',OrderController::class);
          //////////////Stores
        Route::resource('/stores',StoresController::class);
           //////////////Roles
        Route::resource('/roles',RoleController::class);
              //////////////Roles
        Route::resource('/admins',AdminsController::class);
                //////////////Roles
        Route::resource('/users',UsersController::class);
            ////////////// Profile
        Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit');
        Route::patch('profile',[ProfileController::class,'update'])->name('profile.update');
   }
);



