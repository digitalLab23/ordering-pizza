<?php
// app/Business/ProductService.php

namespace app\Business;

use app\Data\ProductDAO;
use app\Models\Product;

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
        return $this->productDAO->findById($id);
    }

    public function addProduct(array $data): void
    {
        $product = new Product($data);
        $this->productDAO->create($product);
    }
}
