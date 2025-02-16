<?php
// app/Data/OrderDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\Order;
use PDO;

class OrderDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findById(int $id): ?Order
    {
        $query = "SELECT * FROM Orders WHERE OrderID = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        return $result ? new Order($result) : null;
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM Orders";
        $statement = $this->connection->query($query);
        $orders = [];

        while ($row = $statement->fetch()) {
            $orders[] = new Order($row);
        }

        return $orders;
    }

    public function create(Order $order): int
    {
        $query = "INSERT INTO Orders (UserID, TotalPrice, DeliveryAddress, DeliveryPostalCode, DeliveryCity, DeliveryInstructions)
                  VALUES (:userId, :totalPrice, :deliveryAddress, :deliveryPostalCode, :deliveryCity, :deliveryInstructions)";
        $statement = $this->connection->prepare($query);

        $statement->execute([
            'userId' => $order->userId,
            'totalPrice' => $order->totalPrice,
            'deliveryAddress' => $order->deliveryAddress,
            'deliveryPostalCode' => $order->deliveryPostalCode,
            'deliveryCity' => $order->deliveryCity,
            'deliveryInstructions' => $order->deliveryInstructions,
        ]);

        return (int) $this->connection->lastInsertId();
    }
}
