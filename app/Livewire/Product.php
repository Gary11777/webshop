<?php

namespace App\Livewire;

use App\Actions\Webshop\AddProductVariantToCart;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Product extends Component
{
    use InteractsWithBanner;
    public $productId;

    public $variant;

    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id']
    ];

    public function mount()
    {
        $this->variant = $this->product->variants()->value('id');
    }

    public function addToCart(AddProductVariantToCart $cart)
    {
        $this->validate();

        $cart->add(
            variantId: $this->variant,
        );

        // Dispatch browser event for the notification banner
        $this->dispatch('banner-message', 
            message: 'Product added to cart', 
            style: 'success'
        );
        
        $this->dispatch('productAddedToCart');
    }
    public function getProductProperty()
    {
        return \App\Models\Product::findOrFail($this->productId);
    }

    public function render()
    {
        return view('livewire.product');
    }
}
