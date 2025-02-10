<?php
// app/Models/Order.php

namespace app\Models;

class Order
{
    public int $id;
    public int $userId;
    public string $orderDate;
    public float $totalPrice;
    public string $deliveryAddress;
    public string $deliveryPostalCode;
    public string $deliveryCity;
    public ?string $deliveryInstructions;

    public function __construct(array $data)
    {
        $this->id = $data['OrderID'] ?? 0;
        $this->userId = $data['UserID'];
        $this->orderDate = $data['OrderDate'];
        $this->totalPrice = $data['TotalPrice'];
        $this->deliveryAddress = $data['DeliveryAddress'];
        $this->deliveryPostalCode = $data['DeliveryPostalCode'];
        $this->deliveryCity = $data['DeliveryCity'];
        $this->deliveryInstructions = $data['DeliveryInstructions'] ?? null;
    }
}
