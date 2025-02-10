<?php
// app/Models/DeliveryArea.php

namespace app\Models;

class DeliveryArea
{
    public int $id;
    public string $postalCode;
    public string $city;

    public function __construct(array $data)
    {
        $this->id = $data['AreaID'] ?? 0;
        $this->postalCode = $data['PostalCode'];
        $this->city = $data['City'];
    }
}
