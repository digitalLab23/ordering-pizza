<?php
// app/Controllers/OrderController.php

namespace app\Controllers;

use app\Business\OrderService;
use app\Helpers\SessionManager;

class OrderController
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
        SessionManager::startSession();
    }

    // Toon winkelmandje
    public function cart(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        require __DIR__ . '/../views/Order/cart.php';
    }

    // Product toevoegen aan winkelmandje
    public function addToCart(int $productId, int $quantity): void
    {
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $quantity;
        } else {
            $_SESSION['cart'][$productId] += $quantity;
        }

        header("Location: /cart");
        exit;
    }

    // Verwijder product uit winkelmandje
    public function removeFromCart(int $productId): void
    {
        unset($_SESSION['cart'][$productId]);
        header("Location: /cart");
        exit;
    }

    // Afrekenpagina
    public function checkout(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->orderService->processOrder($_POST);
            header("Location: /confirmation");
            exit;
        }
        require __DIR__ . '/../views/Order/checkout.php';
    }
}
?>