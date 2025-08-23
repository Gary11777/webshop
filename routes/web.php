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
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/checkout-status', \App\Livewire\CheckoutStatus::class)->name('checkout-status');
    Route::get('/order/{orderId}', \App\Livewire\ViewOrder::class)->name('view-order');
});

require __DIR__.'/auth.php';
