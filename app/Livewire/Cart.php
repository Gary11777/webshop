<?php

namespace App\Livewire;

use App\Actions\Webshop\CreateStripeCheckoutSession;
use App\Factories\CartFactory;
use Livewire\Component;

class Cart extends Component
{
    public function checkout(CreateStripeCheckoutSession $checkoutSession)
    {
        return $checkoutSession->createFromCart($this->cart);
    }

    public function getCartProperty()
    {
        return CartFactory::make()->loadMissing(['items', 'items.product', 'items.variant']);
    }

    public function getItemsProperty()
    {
        return $this->cart->items;
    }

    public function delete($itemId)
    {
        $this->cart->items()->where('id', $itemId)->delete();

//        $this->emit('productRemovedFromCart');
    }

    public function increment($itemId)
    {
        $this->cart->items()->where('id', $itemId)->first()->increment('quantity');
    }

    public function decrement($itemId)
    {
        $item = $this->cart->items()->where('id', $itemId)->first();
        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
