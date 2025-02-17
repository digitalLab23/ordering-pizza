<?php
// views/Order/cart.php

use app\Helpers\SessionManager;

SessionManager::startSession();

// Haal winkelwagengegevens op
$cart = $_SESSION['cart'] ?? [];
$cartTotal = $_SESSION['cart_total'] ?? 0.00;
$isLoggedIn = isset($_SESSION['user_id']);

// Haal fout- en succesmeldingen op
$successMessage = $_SESSION['success'] ?? null;
$errorMessage = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ordering-pizza/public/css/style.css">
    <title>Winkelwagen</title>
</head>

<body>

    <div class="cart-container">
        <h1>Winkelwagen</h1>

        <?php if ($successMessage): ?>
            <div class="success-message"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="error-message"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <?php if (empty($cart)): ?>
            <p>Je winkelwagen is leeg. <br>
        <?php else: ?>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Actie</th>
                </tr>
                <?php foreach ($cart as $productId => $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>€<?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?></td>
                        <td><a href="/ordering-pizza/cart/remove/<?= $productId ?>">Verwijder</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p><strong>Totaalprijs: €<?= number_format($cartTotal, 2, ',', '.') ?></strong></p>

            <?php if ($isLoggedIn): ?>
                <a href="/ordering-pizza/checkout" class="button">Afrekenen</a>
            <?php else: ?>
                <a href="/ordering-pizza/user/login" class="button">Login om af te rekenen</a>
            <?php endif; ?>
        <?php endif; ?>

        <a href="/ordering-pizza/menu" class="button">Verder winkelen</a>
    </div>

</body>

</html>