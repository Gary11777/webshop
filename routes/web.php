<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\Order;
use App\Mail\OrderConfirmation;

Route::get('/', \App\Livewire\StoreFront::class)->name('home');
Route::get('/product/{productId}', \App\Livewire\Product::class)
    ->name('product');
Route::get('/cart', \App\Livewire\Cart::class)
    ->name('cart');
Route::get('/preview', function () {
    $order = Order::first();
    return new OrderConfirmation($order);
});

/*Route::get('/', function () {
    return view('welcome');
})->name('home');*/

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'throttle:120,1'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'throttle:60,1'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // Critical user settings - require password confirmation and stricter rate limiting
    Route::middleware(['password.confirm', 'throttle:10,1'])->group(function () {
        Route::get('settings/password', Password::class)->name('settings.password');
    });
    
    // Standard user settings with moderate protection
    Route::middleware(['throttle:30,1'])->group(function () {
        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });

    // Financial/order routes - maximum security for sensitive operations
    Route::middleware(['throttle:20,1'])->group(function () {
        Route::get('/checkout-status', \App\Livewire\CheckoutStatus::class)->name('webshop.checkout-status');
        Route::get('/order/{orderId}', \App\Livewire\ViewOrder::class)
            ->name('view-order')
            ->where('orderId', '[0-9]+');
            Route::get('/my-orders', \App\Livewire\MyOrders::class)
            ->name('my-orders');
    });
});

require __DIR__.'/auth.php';
