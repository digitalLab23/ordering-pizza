<?php
// views/home/index.php

use app\Helpers\SessionManager;

SessionManager::startSession();

// Controleren of de gebruiker is ingelogd
$isLoggedIn = isset($_SESSION['user_id']);
$successMessage = $_SESSION['success'] ?? null;
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ordering-pizza/public/css/style.css">
    <title>Home</title>
</head>

<body>

    <div class="home-container">
        <h1>Welkom bij onze pizzeria!</h1>
        <p>Bestel eenvoudig en snel je favoriete pizza online.</p>

        <?php if ($successMessage): ?>
            <div class="success-message">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <nav>
            <a class="button" href="/ordering-pizza/menu">Bekijk ons menu</a>
            <a class="button" href="/ordering-pizza/cart">Bekijk je winkelmandje</a>
        </nav>

        <?php if (!$isLoggedIn): ?>
            <p>
                <a href="/ordering-pizza/user/register">Registreren</a> |
                <a href="/ordering-pizza/user/login">Inloggen</a>
            </p>
        <?php else: ?>
            <p class="user-status">
                Ingelogd als <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'klant') ?></strong> |
                <a href="/ordering-pizza/user/logout">Uitloggen</a>
            </p>
        <?php endif; ?>
    </div>

</body>

</html>