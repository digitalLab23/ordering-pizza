<?php

require_once __DIR__ . '/UserDAO.php';

$userDAO = new UserDAO();

echo "</pre>"; // Close preformatted text block

// Test finding a user
$user = $userDAO->findByEmail('test.user@email.com');
if ($user) {
    echo "User Found: " . $user->getEmail() . "\n";
} else {
    echo "User Not Found.\n";
}

echo "<pre>"; // Improves readability for output

// Test creating a new user
$success = $userDAO->createUser(
    "John",                                       // $firstName
    "Doe",                                        // $lastName
    "Baker Street",                               // $street
    "221B",                                       // $houseNumber
    "12345",                                      // $postalCode
    "London",                                     // $city
    null,                                         // $phoneNumber (optional)
    "john.doe@example.com",                       // $email
    password_hash("secret123", PASSWORD_DEFAULT), // $passwordHash
    0,                                            // $promotionEligible (default 0)
    null,                                         // $remarks (optional)
    null                                          // $lastLoginEmail (optional)
);

if ($success) {
    echo "User Registered Successfully!\n";
} else {
    echo "Registration Failed.\n";
}


?>