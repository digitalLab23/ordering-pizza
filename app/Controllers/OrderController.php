<?php
// app/Controllers/OrderController.php

namespace app\Controllers;

use app\Business\ProductService;
use app\Business\OrderService;
use app\Helpers\SessionManager;
use Exception;

class OrderController
{
    private OrderService $orderService;
    private ProductService $productService;

    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->productService = new ProductService();
        SessionManager::startSession();
    }

    public function cart()
    {
        $cart = $_SESSION['cart'] ?? [];
        $cartTotal = $_SESSION['cart_total'] ?? 0;

        require __DIR__ . '/../../views/Order/cart.php';
    }

    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            if (!$productId || $quantity < 1) {
                header("Location: /ordering-pizza/menu?error=Ongeldige+invoer");
                exit;
            }

            $product = $this->productService->getProductById($productId);
            if (!$product) {
                header("Location: /ordering-pizza/menu?error=Product+niet+gevonden");
                exit;
            }

            $_SESSION['cart'][$productId]['name'] = $product->getName();
            $_SESSION['cart'][$productId]['quantity'] = ($_SESSION['cart'][$productId]['quantity'] ?? 0) + $quantity;
            $_SESSION['cart'][$productId]['price'] = $product->getPrice();

            $_SESSION['cart_total'] = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $_SESSION['cart']));

            header("Location: /ordering-pizza/menu");
            exit;
        }
    }

    public function removeFromCart(int $productId)
    {
        if (!isset($_SESSION['cart'][$productId])) {
            header("Location: /ordering-pizza/cart?error=Product+niet+gevonden");
            exit;
        }

        unset($_SESSION['cart'][$productId]);
        $_SESSION['cart_total'] = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $_SESSION['cart']));

        header("Location: /ordering-pizza/cart?success=Product+verwijderd");
        exit;
    }

    public function checkout()
    {
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header("Location: /ordering-pizza/menu?error=Winkelwagen+is+leeg");
            exit;
        }

        require __DIR__ . '/../../views/Order/checkout.php';
    }

    public function confirmOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $postalCode = trim($_POST['postal_code'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $paymentMethod = trim($_POST['payment_method'] ?? '');

            if (empty($name) || empty($address) || empty($postalCode) || empty($city) || empty($paymentMethod)) {
                $_SESSION['error'] = "Vul alle verplichte velden in.";
                header("Location: /ordering-pizza/checkout");
                exit;
            }

            $cart = $_SESSION['cart'] ?? [];
            $cartTotal = $_SESSION['cart_total'] ?? 0;

            if (empty($cart)) {
                $_SESSION['error'] = "Je winkelwagen is leeg.";
                header("Location: /ordering-pizza/menu");
                exit;
            }

            try {
                $orderId = $this->orderService->placeOrder($name, $address, $postalCode, $city, $cart, $cartTotal);

                if ($orderId) {
                    unset($_SESSION['cart'], $_SESSION['cart_total']);
                    $_SESSION['success'] = "Je bestelling is succesvol geplaatst!";
                    header("Location: /ordering-pizza/confirmation");
                    exit;
                }

                throw new Exception("Bestelling kon niet worden geplaatst.");
            } catch (Exception $e) {
                error_log("Fout bij bestelling plaatsen: " . $e->getMessage());
                $_SESSION['error'] = "Bestelling mislukt. Probeer opnieuw.";
                header("Location: /ordering-pizza/checkout");
                exit;
            }
        } else {
            header("Location: /ordering-pizza/checkout");
            exit;
        }
    }
}
