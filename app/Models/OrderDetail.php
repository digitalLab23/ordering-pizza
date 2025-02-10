<?php
// app/Models/OrderDetail.php

namespace app\Models;

class OrderDetail
{
    public int $id;
    public int $orderId;
    public int $productId;
    public int $quantity;
    public float $price;
    public ?string $remarks;

    public function __construct(array $data)
    {
        $this->id = $data['OrderDetailID'] ?? 0;
        $this->orderId = $data['OrderID'];
        $this->productId = $data['ProductID'];
        $this->quantity = $data['Quantity'];
        $this->price = $data['Price'];
        $this->remarks = $data['Remarks'] ?? null;
    }
}
