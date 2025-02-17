<?php
// app/Data/OrderDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\Order;
use PDO;
use Exception;

class OrderDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findById(int $id): ?Order
    {
        try {
            $query = "SELECT * FROM Orders WHERE OrderID = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute(['id' => $id]);
            $result = $statement->fetch();

            return $result ? new Order($result) : null;
        } catch (Exception $e) {
            error_log("Fout bij ophalen bestelling ID $id: " . $e->getMessage());
            return null;
        }
    }

    public function createOrder(string $name, string $address, string $postalCode, string $city, float $totalPrice): ?int
    {
        try {
            $query = "INSERT INTO Orders (CustomerName, Address, PostalCode, City, TotalPrice, OrderDate) 
                  VALUES (:name, :address, :postalCode, :city, :totalPrice, NOW())";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'name' => $name,
                'address' => $address,
                'postalCode' => $postalCode,
                'city' => $city,
                'totalPrice' => $totalPrice
            ]);

            return (int) $this->connection->lastInsertId();
        } catch (Exception $e) {
            error_log("Fout bij het aanmaken van bestelling: " . $e->getMessage());
            return null;
        }
    }
}
