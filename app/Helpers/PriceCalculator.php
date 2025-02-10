<?php
// app/Helpers/PriceCalculator.php

namespace app\Helpers;

class PriceCalculator
{
    public static function calculateTotal(array $cart, float $taxRate = 0.21): float
    {
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {
            $price = 10.00; // => Placeholder prijs, in productie haal je dit uit de database !!
            $subtotal += $price * $quantity;
        }

        $tax = $subtotal * $taxRate;
        return round($subtotal + $tax, 2);
    }
}
