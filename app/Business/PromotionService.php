<?php
// app/Business/PromotionService.php

namespace app\Business;

use app\Data\PromotionDAO;
use app\Models\Promotion;

class PromotionService
{
    private PromotionDAO $promotionDAO;

    public function __construct()
    {
        $this->promotionDAO = new PromotionDAO();
    }

    public function getUserPromotions(int $userId): array
    {
        return $this->promotionDAO->findByUserId($userId);
    }

    public function applyPromotion(int $userId, int $productId): ?float
    {
        $promotions = $this->getUserPromotions($userId);

        foreach ($promotions as $promotion) {
            if ($promotion->productId === $productId) {
                return $promotion->discountPercentage;
            }
        }

        return null;
    }
}
