<?php
// views/Order/checkout.php

use app\Helpers\SessionManager;

SessionManager::startSession();

// Haal winkelwagengegevens op
$cart = $_SESSION['cart'] ?? [];
$cartTotal = $_SESSION['cart_total'] ?? 0.00;

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
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Leveringsgegevens</title>
</head>

<body>

    <div class="checkout-container">
        <h1>Leveringsgegevens</h1>

        <?php if ($successMessage): ?>
            <div class="success-message"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="error-message"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <?php if (empty($cart)): ?>
            <p>Je winkelwagen is leeg. <a href="/ordering-pizza/menu">Ga naar het menu</a></p>
        <?php else: ?>

            <h2>Bestellingsoverzicht</h2>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                </tr>
                <?php foreach ($cart as $productId => $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>€<?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p><strong>Totaal: €<?= number_format($cartTotal, 2, ',', '.') ?></strong></p>

            <form action="/ordering-pizza/order/confirm" method="POST">
                <fieldset>
                    <legend>Leveringsgegevens</legend>
                    <label for="name">Naam:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="address">Adres:</label>
                    <input type="text" id="address" name="address" required>

                    <label for="postal_code">Postcode:</label>
                    <input type="text" id="postal_code" name="postal_code" required>

                    <label for="city">Stad:</label>
                    <input type="text" id="city" name="city" required>
                </fieldset>

                <fieldset>
                    <legend>Betaalmethode</legend>
                    <label for="payment_method">Selecteer je betaalmethode:</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="creditcard">Creditcard</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash">Cash</option>
                        <option value="bank_transfer">Online overschrijving</option>
                    </select>
                </fieldset>

                <button type="submit">Bestelling plaatsen</button>
            </form>

        <?php endif; ?>

        <a href="/ordering-pizza/cart" class="button">Terug naar winkelwagen</a>
    </div>

</body>

</html>