<?php
// app/Data/OrderDetailDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\OrderDetail;
use PDO;
use Exception;

class OrderDetailDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function createOrderDetail(int $orderId, int $productId, int $quantity, float $price): void
    {
        try {
            $query = "INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price)
                      VALUES (:orderId, :productId, :quantity, :price)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'orderId' => $orderId,
                'productId' => $productId,
                'quantity' => $quantity,
                'price' => $price
            ]);
        } catch (Exception $e) {
            error_log("Fout bij toevoegen van orderdetail: " . $e->getMessage());
        }
    }

    public function findByOrderId(int $orderId): array
    {
        try {
            $query = "SELECT * FROM OrderDetails WHERE OrderID = :orderId";
            $statement = $this->connection->prepare($query);
            $statement->execute(['orderId' => $orderId]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Fout bij ophalen orderdetails voor OrderID $orderId: " . $e->getMessage());
            return [];
        }
    }
}
