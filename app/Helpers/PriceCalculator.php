<?php
// app/Helpers/PriceCalculator.php

namespace app\Helpers;

use app\Data\ProductDAO;
use app\Business\PromotionService;

class PriceCalculator
{
    public static function calculateTotal(array $cart, float $defaultTaxRate = 0.21): float
    {
        $subtotal = 0;
        $productDAO = new ProductDAO();
        $promotionService = new PromotionService();

        foreach ($cart as $productId => $item) {
            $product = $productDAO->findById($productId);

            if (!$product) {
                continue; // Skip ongeldige producten
            }

            $price = $product->getPrice();
            $discount = $promotionService->getDiscountByProductId($productId);

            // Korting toepassen
            if ($discount > 0) {
                $price -= ($price * ($discount / 100));
            }

            $subtotal += $price * $item['quantity'];
        }

        $tax = $subtotal * $defaultTaxRate;
        return round($subtotal + $tax, 2);
    }
}
