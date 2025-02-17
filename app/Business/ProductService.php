<?php
// app/Business/ProductService.php

namespace app\Business;

use app\Data\ProductDAO;
use app\Models\Product;
use Exception;

class ProductService
{
    private ProductDAO $productDAO;

    public function __construct()
    {
        $this->productDAO = new ProductDAO();
    }

    public function getAllProducts(): array
    {
        return $this->productDAO->findAll();
    }


    public function getProductById(int $id): ?Product
    {
        try {
            return $this->productDAO->findById($id);
        } catch (Exception $e) {
            error_log("Fout bij ophalen product met ID $id: " . $e->getMessage());
            return null;
        }
    }
}
