<?php
// app/Models/OrderDetail.php

namespace app\Models;

class OrderDetail
{
    private int $id;
    private int $orderId;
    private int $productId;
    private int $quantity;
    private float $price;
    private ?string $remarks;

    public function __construct(array $data)
    {
        $this->id = $data['OrderDetailID'] ?? 0;
        $this->orderId = $data['OrderID'];
        $this->productId = $data['ProductID'];
        $this->quantity = $data['Quantity'];
        $this->price = $data['Price'];
        $this->remarks = $data['Remarks'] ?? null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }
}
