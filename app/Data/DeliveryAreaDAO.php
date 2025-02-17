<?php
// app/Data/DeliveryAreaDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\DeliveryArea;
use PDO;
use Exception;

class DeliveryAreaDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findByPostalCode(string $postalCode): ?DeliveryArea
    {
        try {
            $query = "SELECT * FROM Delivery_Areas WHERE PostalCode = :postalCode";
            $statement = $this->connection->prepare($query);
            $statement->execute(['postalCode' => $postalCode]);
            $result = $statement->fetch();

            return $result ? new DeliveryArea($result) : null;
        } catch (Exception $e) {
            error_log("Fout bij ophalen bezorggebied: " . $e->getMessage());
            return null;
        }
    }

    public function findAll(): array
    {
        try {
            $query = "SELECT * FROM Delivery_Areas";
            $statement = $this->connection->query($query);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Fout bij ophalen alle bezorggebieden: " . $e->getMessage());
            return [];
        }
    }
}
