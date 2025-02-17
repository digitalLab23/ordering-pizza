<?php
// app/Data/ProductDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\Product;
use PDO;
use Exception;

class ProductDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        try {
            $query = "SELECT * FROM Products";
            $statement = $this->connection->query($query);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($results as $row) {
                $products[] = new Product($row); 
            }

            return $products;
        } catch (Exception $e) {
            error_log("Fout bij ophalen producten: " . $e->getMessage());
            return [];
        }
    }


    public function findById(int $id): ?Product
    {
        try {
            $query = "SELECT * FROM Products WHERE ProductID = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute(['id' => $id]);
            $result = $statement->fetch();

            return $result ? new Product($result) : null;
        } catch (Exception $e) {
            error_log("Fout bij ophalen product met ID $id: " . $e->getMessage());
            return null;
        }
    }
}
