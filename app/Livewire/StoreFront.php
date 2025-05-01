<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class StoreFront extends Component
{
    public function getProductsProperty()
    {
        $products = Product::query()->get();

        // Create a formatter for Money objects
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('en_US',
            \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        // Convert Money object to a formatted string
        $products->each(function ($product) use ($moneyFormatter) {
            if ($product->price instanceof Money) {
                $product->price = $moneyFormatter->format($product->price);
            }
        });

        return $products;
    }

    public function render()
    {
        return view('livewire.store-front');
    }
}
