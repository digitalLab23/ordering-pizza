<?php
// TestDbConfig.php

require_once __DIR__ . '/DbConfig.php';

use Config\DbConfig;

try {
    // Get the instance and connection
    $db = DbConfig::getInstance();
    $conn = $db->getConnection();

    // If the connection is successful, echo a success message.
    echo "Connected successfully!";
} catch (Exception $e) {
    // Log the error message and the stack trace
    error_log("Database connection failed: " . $e->getMessage());
    error_log($e->getTraceAsString());

    // Optionally, display the error message to the user (remove in production)
    echo "Connection failed: " . $e->getMessage();
}