<?php

use App\Http\Controllers\Front\Auth\TwoFactorAuthController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SingleProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

  Route::group(
      [
          'prefix' => '/{locale}',
      ],
      function () {

        Route::get('/', [HomeController::class, 'index'])
            ->name('home');

        Route::get('/singleproduct', [SingleProductController::class, 'index'])
            ->name('singleproduct.index');

        Route::get('/singleproduct/{product:slug}', [SingleProductController::class, 'show'])
            ->name('singleproduct.show');

        Route::resource('/cart', CartController::class);

        Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
        Route::post('checkout', [CheckoutController::class, 'store']);



        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        Route::get('auth/user/2fa', [TwoFactorAuthController::class, 'index'])->name('front.2fa');

        Route::post('currency', [CurrencyConverterController::class, 'store'])
            ->name('currency.store');
      }
  );

//require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';