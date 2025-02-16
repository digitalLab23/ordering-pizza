<?php
// app/Models/Product.php

namespace app\Models;

class Product
{
    public int $id;
    public string $name;
    public float $price;
    public ?string $composition;
    public bool $isAvailable;
    public ?float $promotionPrice;
    public string $createdAt;

    public function __construct(array $data)
    {
        $this->id = $data['ProductID'] ?? 0;
        $this->name = $data['ProductName'];
        $this->price = $data['Price'];
        $this->composition = $data['Composition'] ?? null;
        $this->isAvailable = (bool)($data['IsAvailable'] ?? true);
        $this->promotionPrice = $data['PromotionPrice'] ?? null;
        $this->createdAt = $data['CreatedAt'] ?? date('Y-m-d H:i:s');
    }
}
