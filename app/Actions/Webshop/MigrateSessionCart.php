<?php

namespace App\Actions\Webshop;

use App\Models\Cart;

class MigrateSessionCart
{
    public function migrate(Cart $sessionCart, Cart $userCart)
    {
        // Migrate items from session cart to user cart
        $sessionCart->items->each(fn($item) => (new AddProductVariantToCart())->add(
           variantId: $item->product_variant_id,
           quantity: $item->quantity,
           cart: $userCart
        ));

        // Clear the session cart after migration
        $sessionCart->items()->delete();
        $sessionCart->delete();
    }

}
