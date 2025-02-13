<?php
// testCreateUser.php

// Enable error reporting for debugging.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';

use app\Data\UserDAO;

// Instantiate the UserDAO.
$userDao = new UserDAO();

// Prepare sample data for a new user.
$firstName         = 'John';
$lastName          = 'Doe';
$street            = 'Main Street';
$houseNumber       = '123';
$postalCode        = '12345';
$city              = 'Anytown';
$email             = 'john.doe@example.com';
$passwordHash      = password_hash('secret', PASSWORD_BCRYPT);
$phoneNumber       = '555-1234';
$promotionEligible = 1; // or 0 if not eligible.
$remarks           = 'Test user';
$lastLoginEmail    = null;

// Attempt to create the user.
// Note that the phone number is now the last parameter.
$result = $userDao->createUser(
    $firstName,
    $lastName,
    $street,
    $houseNumber,
    $postalCode,
    $city,
    $email,
    $passwordHash,
    $phoneNumber,
    $promotionEligible,
    $remarks,
    $lastLoginEmail
);

// Output the result.
echo '<h2>Create User Result</h2>';
if ($result) {
    echo '<p>User created successfully.</p>';
} else {
    echo '<p>Failed to create user.</p>';
}

// Optionally, retrieve and display the user using findByEmail to verify the insertion.
$user = $userDao->findByEmail($email);
echo '<pre>';
print_r($user);
echo '</pre>';
?>