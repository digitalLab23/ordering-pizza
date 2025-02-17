<?php
// app/Data/PromotionDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\Promotion;
use PDO;
use Exception;

class PromotionDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function getPromotionByProductId(int $productId): ?Promotion
    {
        try {
            $query = "SELECT * FROM Promotions WHERE ProductID = :productId";
            $statement = $this->connection->prepare($query);
            $statement->execute(['productId' => $productId]);
            $result = $statement->fetch();

            return $result ? new Promotion($result) : null;
        } catch (Exception $e) {
            error_log("Fout bij ophalen promotie voor product $productId: " . $e->getMessage());
            return null;
        }
    }
}
