<?php
// app/Controllers/UserController.php

namespace app\Controllers;

use app\Business\UserService;
use app\Helpers\SessionManager;
use app\Helpers\Validator;
use Exception;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
        SessionManager::startSession();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $street = trim($_POST['street'] ?? '');
            $houseNumber = trim($_POST['house_number'] ?? '');
            $postalCode = trim($_POST['postal_code'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $phoneNumber = trim($_POST['phone_number'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $errors = Validator::validateRegistration($firstName, $lastName, $email, $password, $confirmPassword);
            if (!empty($errors)) {
                $_SESSION['error'] = implode(' ', $errors);
                header("Location: /ordering-pizza/user/register");
                exit;
            }

            try {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $success = $this->userService->createUser(
                    $firstName,
                    $lastName,
                    $street,
                    $houseNumber,
                    $postalCode,
                    $city,
                    $phoneNumber,
                    $email,
                    $passwordHash,
                    0
                );

                if ($success) {
                    $_SESSION['success'] = "Account succesvol aangemaakt!";
                    header("Location: /ordering-pizza/user/login");
                    exit;
                }
                throw new Exception("Registratie mislukt.");
            } catch (Exception $e) {
                error_log("Fout bij registratie: " . $e->getMessage());
                header("Location: /ordering-pizza/user/register?error=Registratie+mislukt.");
                exit;
            }
        }
        require __DIR__ . '/../../views/User/register.php';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userService->getUserByEmail($email);

            if ($user && password_verify($password, $user->getPasswordHash())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['success'] = "Welkom, " . htmlspecialchars($user->getFirstName()) . "!";
                header("Location: /ordering-pizza/");
                exit;
            } else {
                $_SESSION['error'] = "Fout: De combinatie van e-mail en wachtwoord is incorrect.";
                header("Location: /ordering-pizza/user/login");
                exit;
            }
        } else {
            require __DIR__ . '/../../views/User/login.php';
        }
    }

    public function logout()
    {
        SessionManager::logout();
        header("Location: /ordering-pizza/user/login?message=Je+bent+uitgelogd.");
        exit;
    }
}
