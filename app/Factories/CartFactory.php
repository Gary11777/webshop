<?php

namespace App\Factories;

use App\Models\Cart;

class CartFactory
{
    public static function make(): Cart
    {
        if (auth()->guest()) {
            $cart = Cart::firstOrCreate(['session_id' => session()->getId()]);
            // Store the cart ID in session for later retrieval after login
            session()->put('guest_cart_id', $cart->id);
            return $cart;
        } else {
            return auth()->user()->cart ?: auth()->user()->cart()->create();
        }
    }
}
