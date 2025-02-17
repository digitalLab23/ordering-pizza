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
        try {
            $this->connection = DbConfig::getInstance()->getConnection();
        } catch (Exception $e) {
            error_log("Fout bij databaseverbinding in OrderDAO: " . $e->getMessage());
            throw new Exception("Databaseverbinding mislukt.");
        }
    }

    public function findById(int $id): ?Order
    {
        try {
            $query = "SELECT * FROM Orders WHERE OrderID = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute(['id' => $id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Order($result) : null;
        } catch (Exception $e) {
            error_log("Fout bij ophalen bestelling ID $id: " . $e->getMessage());
            return null;
        }
    }

    public function createOrder(?int $userId, string $address, string $postalCode, string $city, float $totalPrice): ?int
    {
        try {
            $query = "INSERT INTO Orders (UserID, DeliveryAddress, DeliveryPostalCode, DeliveryCity, TotalPrice, OrderDate) 
                      VALUES (:userId, :address, :postalCode, :city, :totalPrice, NOW())";

            $statement = $this->connection->prepare($query);
            $statement->execute([
                'userId' => $userId,
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

    public function findAll(): array
    {
        try {
            $query = "SELECT * FROM Orders ORDER BY OrderDate DESC";
            $statement = $this->connection->query($query);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Fout bij ophalen van alle bestellingen: " . $e->getMessage());
            return [];
        }
    }
}
