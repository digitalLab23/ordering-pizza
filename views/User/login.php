<?php
// views/User/login.php

// Start de sessie als deze nog niet gestart is
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check of de gebruiker al ingelogd is
if (isset($_SESSION['user_id'])) {
    header("Location: /ordering-pizza/");
    exit;
}

// Haal fout- en succesberichten op
$successMessage = $_SESSION['success'] ?? ($_GET['message'] ?? null);
$errorMessage = $_SESSION['error'] ?? ($_GET['error'] ?? null);

// Verwijder sessieberichten na weergave
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ordering-pizza/public/css/style.css">
    <title>Login</title>
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
            <label for="email">Email:</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Voer je email in"
                required>

            <label for="password">Wachtwoord:</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Voer je wachtwoord in"
                required>

            <label>
                <input type="checkbox" name="remember_me">
                Onthoud mij
            </label>

            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <button type="submit">Inloggen</button>
        </form>

        <p>
            Nog geen account?
            <a href="register">Registreer hier</a>
        </p>

        <a class="button back-home" href="/ordering-pizza/">Terug naar Home</a>
    </div>

</body>

</html>