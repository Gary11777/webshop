<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Component;

class Cart extends Component
{
    public function getItemsProperty()
    {
        return CartFactory::make()->items;
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
