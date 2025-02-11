<?php

// app/Controllers/UserController.php

namespace app\Controllers;

use app\Business\UserService;
use app\Data\UserDAO;

class UserController
{
    private UserDAO $userDAO;

    public function __construct()
    {
        // Adjust this to however you normally get your DAO or DB connection
        $this->userDAO = new UserDAO();
    }

    public function register()
    {
        // If the request is POST, process the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Collect Form Data (ensure the field names match register.php)
            $firstName       = trim($_POST['first_name'] ?? '');
            $lastName        = trim($_POST['last_name'] ?? '');
            $street          = trim($_POST['street'] ?? '');
            $houseNumber     = trim($_POST['house_number'] ?? '');
            $postalCode      = trim($_POST['postal_code'] ?? '');
            $city            = trim($_POST['city'] ?? '');
            $phoneNumber     = trim($_POST['phone_number'] ?? '');
            $email           = trim($_POST['email'] ?? '');
            $password        = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            // If the checkbox is checked, you'll get promotion_eligible=1;
            // if not checked, it won't exist, so default to 0.
            $promotionEligible = isset($_POST['promotion_eligible']) ? 1 : 0;

            // 2. Basic Validation
            // (You can expand this based on your requirements)
            if ($firstName === '' || $lastName === '' || $street === '' || 
                $houseNumber === '' || $postalCode === '' || $city === '' || 
                $email === '' || $password === '' || $confirmPassword === '') {
                header("Location: /User/register?error=Please+fill+in+all+required+fields");
                exit;
            }

            if ($password !== $confirmPassword) {
                header("Location: /User/register?error=Passwords+do+not+match");
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: /User/register?error=Invalid+email+address");
                exit;
            }

            // 3. Hash the Password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // 4. Call the createUser method
            // Make sure the parameter order matches your createUser(...) definition
            $success = $this->userDAO->createUser(
                $firstName,
                $lastName,
                $street,
                $houseNumber,
                $postalCode,
                $city,
                $phoneNumber !== '' ? $phoneNumber : null, // pass null if empty
                $email,
                $passwordHash,
                $promotionEligible
                // If you have optional remarks / lastLoginEmail, pass them here too
            );

            // 5. Redirect Depending on Insert Success or Failure
            if ($success) {
                header("Location: /User/login?message=Registration+successful");
                exit;
            } else {
                header("Location: /User/register?error=Registration+failed");
                exit;
            }

        } else {
            // GET or other method: just show the form
            require_once __DIR__ . '/../views/User/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Gather form data
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // 2. Validate and attempt to login
            //    e.g., check if user with $email exists, then verify password
            //    password_verify($password, $storedHash)

            // 3. On success: set session, redirect to homepage or user dashboard
            // 4. On failure: redirect back with error
            //    header("Location: /User/login?error=Invalid+credentials");
            //    exit;
        } else {
            // Not a POST request -> just show the login form
            require_once __DIR__ . '/../views/User/login.php';
        }
    }
}
?>