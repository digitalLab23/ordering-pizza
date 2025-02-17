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

    public function placeOrder($userId, $address, $postalCode, $city, $cart, $cartTotal)
    {
        try {
            $orderId = $this->orderDAO->createOrder($userId, $address, $postalCode, $city, $cartTotal);

            if (!$orderId) {
                throw new Exception("Order ID niet gegenereerd.");
            }

            foreach ($cart as $productId => $item) {
                $this->orderDetailDAO->createOrderDetail($orderId, $productId, $item['quantity'], $item['price']);
            }

            return $orderId;
        } catch (Exception $e) {
            return null;
        }
    }
}
