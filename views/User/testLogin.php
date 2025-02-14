<?php
// testLogin.php

// Enable error reporting for debugging.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Adjust the autoload path if necessary. This example assumes your vendor folder is two levels up.
require_once __DIR__ . '/../../vendor/autoload.php';

use app\Data\UserDAO;

$message = '';

// Check if the form was submitted.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize login data.
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Instantiate the UserDAO.
    $userDao = new UserDAO();
    
    // Attempt to retrieve the user by email.
    $user = $userDao->findByEmail($email);
    
    if ($user) {
        // Access the password hash using object property syntax.
        if (password_verify($password, $user->getPasswordHash())) {
            $message = "Login successful!";
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Login</title>
    <!-- Include your CSS if needed -->
</head>
<body>
    <h1>Login</h1>
    
    <!-- Display feedback message -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    
    <!-- Login Form -->
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="Enter your email" 
            required
        >
        <br>
        
        <label for="password">Password:</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Enter your password" 
            required
        >
        <br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>