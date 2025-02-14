<?php
// app/Data/OrderDetailDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\OrderDetail;
use PDO;

class OrderDetailDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findByOrderId(int $orderId): array
    {
        $query = "SELECT * FROM Order_Details WHERE OrderID = :orderId";
        $statement = $this->connection->prepare($query);
        $statement->execute(['orderId' => $orderId]);
        $details = [];

        while ($row = $statement->fetch()) {
            $details[] = new OrderDetail($row);
        }

        return $details;
    }

    public function create(OrderDetail $orderDetail): void
    {
        $query = "INSERT INTO Order_Details (OrderID, ProductID, Quantity, Price, Remarks)
                  VALUES (:orderId, :productId, :quantity, :price, :remarks)";
        $statement = $this->connection->prepare($query);

        $statement->execute([
            'orderId' => $orderDetail->orderId,
            'productId' => $orderDetail->productId,
            'quantity' => $orderDetail->quantity,
            'price' => $orderDetail->price,
            'remarks' => $orderDetail->remarks,
        ]);
    }
}
