<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Money\Money;
use Money\Currency;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Handle null values
        if ($value === null) {
            return new Money(0, new Currency('USD'));
        }

        // If value is already an integer (cents), use it directly
        if (is_int($value)) {
        return new Money($value, new Currency('USD'));
    }

        // If value is a string, clean it and convert to cents
        if (is_string($value)) {
            // Remove currency symbols and whitespace
            $cleanValue = preg_replace('/[^\d.-]/', '', $value);
            
            // Convert to float then to cents (multiply by 100)
            $cents = (int) round((float) $cleanValue * 100);
            
            return new Money($cents, new Currency('USD'));
        }

        // If value is a float, convert to cents
        if (is_float($value)) {
            $cents = (int) round($value * 100);
            return new Money($cents, new Currency('USD'));
        }

        // Fallback to 0 for any other type
        return new Money(0, new Currency('USD'));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
