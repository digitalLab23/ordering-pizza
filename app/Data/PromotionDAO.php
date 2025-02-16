<?php
// app/Data/PromotionDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\Promotion;
use PDO;

class PromotionDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findByUserId(int $userId): array
    {
        $query = "SELECT * FROM Promotions WHERE UserID = :userId";
        $statement = $this->connection->prepare($query);
        $statement->execute(['userId' => $userId]);
        $promotions = [];

        while ($row = $statement->fetch()) {
            $promotions[] = new Promotion($row);
        }

        return $promotions;
    }

    public function create(Promotion $promotion): void
    {
        $query = "INSERT INTO Promotions (UserID, ProductID, DiscountPercentage, StartDate, EndDate)
                  VALUES (:userId, :productId, :discountPercentage, :startDate, :endDate)";
        $statement = $this->connection->prepare($query);

        $statement->execute([
            'userId' => $promotion->userId,
            'productId' => $promotion->productId,
            'discountPercentage' => $promotion->discountPercentage,
            'startDate' => $promotion->startDate,
            'endDate' => $promotion->endDate,
        ]);
    }
}
