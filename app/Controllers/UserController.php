<?php
// app/Controllers/UserController.php

namespace app\Controllers;

use app\Data\UserDAO;

ini_set('display_errors', 1);
error_reporting(E_ALL);

class UserController
{
    private UserDAO $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Collect Form Data (ensure the field names match register.php)
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

            // If the checkbox is checked, you'll get promotion_eligible=1;
            // if not checked, it won't exist, so default to 0.
            $promotionEligible = isset($_POST['promotion_eligible']) ? 1 : 0;

            // 2. Basic Validation
            if ($firstName === '' || $lastName === '' || $street === '' || 
                $houseNumber === '' || $postalCode === '' || $city === '' || 
                $email === '' || $password === '' || $confirmPassword === '') {
                header("Location: /ordering-pizza/user/register?error=Please+fill+in+all+required+fields");
                exit;
            }

            if ($password !== $confirmPassword) {
                header("Location: /ordering-pizza/user/register?error=Passwords+do+not+match");
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: /ordering-pizza/user/register?error=Invalid+email+address");
                exit;
            }

            // 3. Hash the Password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // 4. Call the createUser method
            $success = $this->userDAO->createUser(
                $firstName,
                $lastName,
                $street,
                $houseNumber,
                $postalCode,
                $city,
                $email,
                $passwordHash,
                $phoneNumber !== '' ? $phoneNumber : null,
                $promotionEligible
            );

            // 5. Redirect Depending on Insert Success or Failure
            if ($success) {
                header("Location: /ordering-pizza/user/login?message=Registration+successful");
                exit;
            } else {
                header("Location: /ordering-pizza/user/register?error=Registration+failed");
                exit;
            }
        } else {
            // Include the registration view using the correct relative path.
            // Since this controller is located in ordering-pizza/app/Controllers/,
            // going up two levels (../../) will reach ordering-pizza/ then down to views/User/register.php.
            require_once __DIR__ . '/../../views/User/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process login submission:
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
    
            // Validate credentials using the correct DAO method
            $user = $this->userDAO->findByEmail($email);
    
            // Access the passwordHash property as an object property instead of an array key
            if ($user && password_verify($password, $user->getPasswordHash())) {
                // Set session or other login-related state here
                $_SESSION['user'] = $user;
    
                // Redirect to the main page or dashboard after successful login
                header("Location: /ordering-pizza");
                exit;
            } else {
                // Redirect back to login with an error message if credentials are invalid
                header("Location: /ordering-pizza/user/login?error=Invalid+credentials");
                exit;
            }
        } else {
            require_once __DIR__ . '/../../views/User/login.php';
        }
    }
}
?>