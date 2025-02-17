<?php
// views/User/login.php

use app\Helpers\SessionManager;

SessionManager::startSession();

// Check of de gebruiker al ingelogd is
if (isset($_SESSION['user_id'])) {
    header("Location: /ordering-pizza/");
    exit;
}

// Haal fout- en succesberichten op
$successMessage = $_SESSION['success'] ?? ($_GET['message'] ?? null);
$errorMessage = $_SESSION['error'] ?? ($_GET['error'] ?? null);
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ordering-pizza/public/css/style.css">
    <title>Login</title>
    <style>
        .error-message {
            background: #ffcccc;
            color: #d62828;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .input-error {
            border: 2px solid #d62828;
            background: #ffcccc;
        }
    </style>
</head>

<body>

    <div class="auth-container">
        <h1>Login</h1>

        <?php if ($successMessage): ?>
            <div class="success-message">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="error-message">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <form action="/ordering-pizza/user/login" method="POST">
            <label for="email">E-mail:</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Voer je e-mail in"
                required
                class="<?= $errorMessage ? 'input-error' : '' ?>">

            <label for="password">Wachtwoord:</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Voer je wachtwoord in"
                required
                class="<?= $errorMessage ? 'input-error' : '' ?>">

            <label>
                <input type="checkbox" name="remember_me">
                Onthoud mij
            </label>

            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <button type="submit">Inloggen</button>
        </form>

        <p>
            Nog geen account?
            <a href="/ordering-pizza/user/register">Registreer hier</a>
        </p>

        <a class="button back-home" href="/ordering-pizza/">Terug naar Home</a>
    </div>

</body>

</html>