<?php
// app/Controllers/ProductController.php

namespace app\Controllers;

use app\Business\ProductService;
use app\Helpers\SessionManager;
use Exception;

class ProductController
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
        SessionManager::startSession();
    }

    public function index()
    {
        try {
            $products = $this->productService->getAllProducts();
            require __DIR__ . '/../../views/Product/menu.php';
        } catch (Exception $e) {
            error_log("Fout bij laden producten: " . $e->getMessage());
            header("Location: /ordering-pizza/home?error=Kan+menu+niet+laden");
            exit;
        }
    }
}
