<?php
// app/Business/DeliveryService.php

namespace app\Business;

use app\Data\DeliveryAreaDAO;

class DeliveryService
{
    private DeliveryAreaDAO $deliveryAreaDAO;

    public function __construct()
    {
        $this->deliveryAreaDAO = new DeliveryAreaDAO();
    }

    public function isDeliveryAvailable(string $postalCode): bool
    {
        try {
            return $this->deliveryAreaDAO->findByPostalCode($postalCode) !== null;
        } catch (\Exception $e) {
            error_log("Fout bij controleren bezorggebied: " . $e->getMessage());
            return false;
        }
    }
}
