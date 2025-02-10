<?php
// app/Models/Promotion.php

namespace app\Models;

class Promotion
{
    public int $id;
    public int $userId;
    public ?int $productId;
    public float $discountPercentage;
    public string $startDate;
    public string $endDate;

    public function __construct(array $data)
    {
        $this->id = $data['PromotionID'] ?? 0;
        $this->userId = $data['UserID'];
        $this->productId = $data['ProductID'] ?? null;
        $this->discountPercentage = $data['DiscountPercentage'];
        $this->startDate = $data['StartDate'];
        $this->endDate = $data['EndDate'];
    }
}
