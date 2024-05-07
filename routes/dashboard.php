<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'dashboard',
        'as' => "dashboard.",
        "middleware" => ['auth']
    ],
    function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        
        // CategoriesController
        Route::get(
            '/categories/trash',
            [CategoriesController::class, 'trash']
        )->name('categories.trash');

        Route::put(
            '/categories/{category}/restore',
            [CategoriesController::class, 'restore']
        )->name('categories.restore');

        Route::delete(
            '/categories/{category}/force-delete',
            [CategoriesController::class, 'forceDelete']
        )->name('categories.force-delete');

        Route::resource('/categories', CategoriesController::class);


        // ProductController
        Route::get(
            '/products/trash',
            [CategoriesController::class, 'trash']
        )->name('products.trash');

        Route::resource('/products', ProductController::class);
    }
);


// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::resource('dashboard/categories', CategoriesController::class);