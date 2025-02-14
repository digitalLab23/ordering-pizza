<?php
// testRegister.php

// Enable error reporting for debugging.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Adjust the autoload path if necessary (this assumes your vendor folder is two levels up from this file).
require_once __DIR__ . '/../../vendor/autoload.php';

use app\Data\UserDAO;

$message = '';

// Check if the form was submitted.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form input.
    $firstName       = trim($_POST['first_name'] ?? '');
    $lastName        = trim($_POST['last_name'] ?? '');
    $street          = trim($_POST['street'] ?? '');
    $houseNumber     = trim($_POST['house_number'] ?? '');
    $postalCode      = trim($_POST['postal_code'] ?? '');
    $city            = trim($_POST['city'] ?? '');
    $email           = trim($_POST['email'] ?? '');
    $password        = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $phoneNumber     = trim($_POST['phone_number'] ?? '');
    $promotionEligible = isset($_POST['promotion_eligible']) ? 1 : 0;

    // Basic validation: ensure password and confirm password match.
    if ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
    } else {
        // Hash the password.
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        // Additional optional fields.
        $remarks = '';         // You can modify this if needed.
        $lastLoginEmail = null; // Set to null for now.

        // Create an instance of UserDAO.
        $userDao = new UserDAO();

        /* 
         * Call createUser with the following order:
         * 1. firstName
         * 2. lastName
         * 3. street
         * 4. houseNumber
         * 5. postalCode
         * 6. city
         * 7. email
         * 8. passwordHash
         * 9. phoneNumber (moved immediately after passwordHash)
         * 10. promotionEligible
         * 11. remarks
         * 12. lastLoginEmail
         */
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

        if ($result) {
            $message = "User registered successfully!";
        } else {
            $message = "User registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Register</title>
    <!-- Adjust the path to your CSS file if necessary -->
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h2>Register</h2>

    <!-- Display any message -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Registration Form -->
    <form action="" method="POST">
        <label for="first_name">First Name (required):</label>
        <input type="text" id="first_name" name="first_name" required>
        <br>

        <label for="last_name">Last Name (required):</label>
        <input type="text" id="last_name" name="last_name" required>
        <br>

        <label for="street">Street (required):</label>
        <input type="text" id="street" name="street" required>
        <br>

        <label for="house_number">House Number (required):</label>
        <input type="text" id="house_number" name="house_number" required>
        <br>

        <label for="postal_code">Postal Code (required):</label>
        <input type="text" id="postal_code" name="postal_code" required>
        <br>

        <label for="city">City (required):</label>
        <input type="text" id="city" name="city" required>
        <br>

        <label for="email">Email (required):</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Password (required):</label>
        <input type="password" id="password" name="password" required>
        <br>

        <label for="confirm_password">Confirm Password (required):</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>

        <label for="phone_number">Phone Number (optional):</label>
        <input type="text" id="phone_number" name="phone_number">
        <br>

        <label for="promotion_eligible">
            <input type="checkbox" id="promotion_eligible" name="promotion_eligible" value="1">
            Sign up for promotions (optional)
        </label>
        <br>

        <button type="submit">Register</button>
    </form>
</body>
</html>