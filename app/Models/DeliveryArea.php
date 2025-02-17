<?php
// app/Models/DeliveryArea.php

namespace app\Models;

class DeliveryArea
{
    private int $id;
    private string $postalCode;
    private string $city;

    public function __construct(array $data)
    {
        $this->id = $data['AreaID'] ?? 0;
        $this->postalCode = $data['PostalCode'];
        $this->city = $data['City'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
