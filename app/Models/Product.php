<?php
// app/Models/Product.php

namespace app\Models;

class Product
{
    private int $id;
    private string $name;
    private float $price;
    private ?string $composition;

    public function __construct(array $data)
    {
        $this->id = $data['ProductID'] ?? 0;
        $this->name = $data['ProductName'];
        $this->price = $data['Price'];
        $this->composition = $data['Composition'] ?? null;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getComposition(): ?string
    {
        return $this->composition;
    }
}
