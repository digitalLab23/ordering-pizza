<?php

namespace app\Data;
use app\Data\UserDAO;

// Autoload classes (Composer of custom autoloader)
require_once __DIR__ . '/../../vendor/autoload.php';

$userDAO = new UserDAO();

// Test creating a new user
$success = $userDAO->createUser(
    "Robin",                                       // $firstName
    "Son",                                        // $lastName
    "Rob Street",                               // $street
    "6",                                       // $houseNumber
    "3612",                                      // $postalCode
    "Genk",                                     // $city
    "0493939495",                                         // $phoneNumber (optional)
    "Robin.Son@example.com",                       // $email
    password_hash("Test1paswoord", PASSWORD_DEFAULT), // $passwordHash
    0,                                            // $promotionEligible (default 0)
    null,                                         // $remarks (optional)
    null                                          // $lastLoginEmail (optional)
);

if ($success) {
    echo "User Registered Successfully!\n";
} else {
    echo "Registration Failed.\n";
}

echo "</pre>"; // Close preformatted text block

// Test finding a user
$user = $userDAO->findByEmail('test.user@email.com');
if ($user) {
    echo "User Found: " . $user->getEmail() . "\n";
} else {
    echo "User Not Found.\n";
}

echo "<pre>"; // Improves readability for output
?>