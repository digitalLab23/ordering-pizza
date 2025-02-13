<?php
// app/Controllers/ProductController.php

namespace app\Controllers;

use app\Business\ProductService;
use app\Data\ProductDAO;
use app\Models\Product;

class ProductController
{
    private ProductService $productService;
    private ProductDAO $productDAO;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->productDAO = new ProductDAO();
    }

    public function index(): void
    {
        $products = $this->productService->getAllProducts();
        require __DIR__ . '/../views/Product/menu.php';
    }

    public function details(int $id): void
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            http_response_code(404);
            echo "<h1>Product niet gevonden</h1>";
            return;
        }
        require __DIR__ . '/../views/Product/details.php';
    }
}
?>