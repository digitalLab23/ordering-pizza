<?php
// app/Models/Order.php

namespace app\Models;

class Order
{
    private int $id;
    private int $userId;
    private string $orderDate;
    private float $totalPrice;
    private string $deliveryAddress;
    private string $deliveryPostalCode;
    private string $deliveryCity;
    private ?string $deliveryInstructions;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    public function getDeliveryPostalCode(): string
    {
        return $this->deliveryPostalCode;
    }

    public function getDeliveryCity(): string
    {
        return $this->deliveryCity;
    }

    public function getDeliveryInstructions(): ?string
    {
        return $this->deliveryInstructions;
    }
}
