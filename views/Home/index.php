<?php
// views/home/index.php

error_reporting(E_ALL);
// Serve static files (CSS/JS/images) directly if they exist
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$staticFile = __DIR__ . $requestPath;
if (file_exists($staticFile) && is_file($staticFile)) {
    $mimeType = mime_content_type($staticFile);
    header('Content-Type: ' . $mimeType);
    readfile($staticFile);
    exit;
}

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
    <link rel="stylesheet" href="/public/css/style.css">
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