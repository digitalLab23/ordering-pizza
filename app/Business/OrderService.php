<?php
// app/Business/OrderService.php

namespace app\Business;

use app\Data\OrderDAO;
use app\Data\OrderDetailDAO;
use Exception;

class OrderService
{
    private OrderDAO $orderDAO;
    private OrderDetailDAO $orderDetailDAO;

    public function __construct()
    {
        $this->orderDAO = new OrderDAO();
        $this->orderDetailDAO = new OrderDetailDAO();
    }
    public function placeOrder(string $name, string $address, string $postalCode, string $city, array $cart, float $cartTotal): ?int
    {
        try {
            if (empty($name) || empty($address) || empty($postalCode) || empty($city) || empty($cart)) {
                throw new Exception("Bestelling niet voltooid: verplichte velden ontbreken.");
            }

            $orderId = $this->orderDAO->createOrder($name, $address, $postalCode, $city, $cartTotal);

            if (!$orderId) {
                throw new Exception("Order ID niet gegenereerd.");
            }

            foreach ($cart as $productId => $item) {
                if (!isset($item['quantity'], $item['price'])) {
                    throw new Exception("Onjuiste productgegevens voor product $productId.");
                }
                $this->orderDetailDAO->createOrderDetail($orderId, $productId, $item['quantity'], $item['price']);
            }

            return $orderId;
        } catch (Exception $e) {
            error_log("Fout bij bestelling plaatsen: " . $e->getMessage());
            return null;
        }
    }
}
