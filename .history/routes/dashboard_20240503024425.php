<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'dashboard',
        'as' => "dashboard.",
        "middleware" => ['auth']
    ],
    function () {

        Route::get('/', [DashboardController::class, 'index'])
           

        Route::resource('dashboard/categories', CategoriesController::class);

    }
);


// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::resource('dashboard/categories', CategoriesController::class);