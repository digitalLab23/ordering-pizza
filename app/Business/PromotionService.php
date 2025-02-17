<?php
// app/Business/PromotionService.php

namespace app\Business;

use app\Data\PromotionDAO;
use Exception;

class PromotionService
{
    private PromotionDAO $promotionDAO;

    public function __construct()
    {
        $this->promotionDAO = new PromotionDAO();
    }

    public function getDiscountByProductId(int $productId): float
    {
        try {
            $promotion = $this->promotionDAO->getPromotionByProductId($productId);
            return $promotion ? $promotion->getDiscountPercentage() : 0;
        } catch (Exception $e) {
            error_log("Fout bij ophalen promotie voor product $productId: " . $e->getMessage());
            return 0;
        }
    }
}
