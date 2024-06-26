<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        "middleware" => ['auth:admin'],
        'as' => "dashboard.",
        'prefix' => 'admin/dashboard',
        // "middleware" => ['auth', 'auth.type:admin,super-admin']
    ],
    function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');


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
            [ProductController::class, 'trash']
        )->name('products.trash');

        Route::resource('/products', ProductController::class);
    }
);


// Route::middleware('quth')->prefix('dashboard')->as('dashboard.')->group(function(){});