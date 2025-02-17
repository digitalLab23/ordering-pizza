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

            $orderId = (int) $this->connection->lastInsertId();

            if (!$orderId) {
                throw new Exception("Order ID niet gegenereerd.");
            }

            return $orderId;
        } catch (Exception $e) {
            error_log("Fout bij aanmaken bestelling: " . $e->getMessage());
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
