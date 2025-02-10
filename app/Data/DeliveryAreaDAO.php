<?php
// app/Data/DeliveryAreaDAO.php

namespace app\Data;

use app\Config\DbConfig;
use app\Models\DeliveryArea;
use PDO;

class DeliveryAreaDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findByPostalCode(string $postalCode): ?DeliveryArea
    {
        $query = "SELECT * FROM Delivery_Areas WHERE PostalCode = :postalCode";
        $statement = $this->connection->prepare($query);
        $statement->execute(['postalCode' => $postalCode]);
        $result = $statement->fetch();

        return $result ? new DeliveryArea($result) : null;
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM Delivery_Areas";
        $statement = $this->connection->query($query);
        $areas = [];

        while ($row = $statement->fetch()) {
            $areas[] = new DeliveryArea($row);
        }

        return $areas;
    }
}
