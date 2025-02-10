<?php
// app/Business/OrderService.php

namespace app\Business;

use app\Data\OrderDAO;
use app\Data\OrderDetailDAO;
use app\Helpers\PriceCalculator;
use app\Models\Order;
use app\Models\OrderDetail;

class OrderService
{
    private OrderDAO $orderDAO;
    private OrderDetailDAO $orderDetailDAO;

    public function __construct()
    {
        $this->orderDAO = new OrderDAO();
        $this->orderDetailDAO = new OrderDetailDAO();
    }

    public function processOrder(array $orderData): void
    {
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            throw new \Exception("Winkelmandje is leeg!");
        }

        $totalPrice = PriceCalculator::calculateTotal($cart);
        $order = new Order([
            'UserID' => $_SESSION['user_id'] ?? null,
            'TotalPrice' => $totalPrice,
            'DeliveryAddress' => $orderData['address'],
            'DeliveryPostalCode' => $orderData['postal_code'],
            'DeliveryCity' => $orderData['city'],
            'DeliveryInstructions' => $orderData['instructions'] ?? null
        ]);

        $orderId = $this->orderDAO->create($order);

        foreach ($cart as $productId => $quantity) {
            $orderDetail = new OrderDetail([
                'OrderID' => $orderId,
                'ProductID' => $productId,
                'Quantity' => $quantity,
                'Price' => 10.00 // => Placeholder prijs, in productie haal je dit uit de database !!
            ]);
            $this->orderDetailDAO->create($orderDetail);
        }

        unset($_SESSION['cart']);
    }
}
