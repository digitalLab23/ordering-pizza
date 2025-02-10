<?php
// app/Data/ProductDAO.php

namespace app\Data;

use app\Config\DbConfig;
use app\Models\Product;
use PDO;

class ProductDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM Products";
        $statement = $this->connection->query($query);
        $products = [];

        while ($row = $statement->fetch()) {
            $products[] = new Product($row);
        }

        return $products;
    }

    public function findById(int $id): ?Product
    {
        $query = "SELECT * FROM Products WHERE ProductID = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        return $result ? new Product($result) : null;
    }

    public function create(Product $product): void
    {
        $query = "INSERT INTO Products (ProductName, Price, Composition, IsAvailable, PromotionPrice)
                  VALUES (:name, :price, :composition, :isAvailable, :promotionPrice)";
        $statement = $this->connection->prepare($query);

        $statement->execute([
            'name' => $product->name,
            'price' => $product->price,
            'composition' => $product->composition,
            'isAvailable' => $product->isAvailable,
            'promotionPrice' => $product->promotionPrice,
        ]);
    }
}
