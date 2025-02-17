<?php
// app/Models/Promotion.php

namespace app\Models;

class Promotion
{
    private int $id;
    private int $productId;
    private float $discountPercentage;

    public function __construct(array $data)
    {
        $this->id = $data['PromotionID'] ?? 0;
        $this->productId = $data['ProductID'];
        $this->discountPercentage = $data['DiscountPercentage'];
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }
}
