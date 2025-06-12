<?php
// views/confirmation.php

use app\Helpers\SessionManager;

SessionManager::startSession();

// Haal ordergegevens op uit de sessie
$orderId = $_SESSION['order_id'] ?? null;
$orderTotal = $_SESSION['order_total'] ?? 0.00;
$orderItems = $_SESSION['order_items'] ?? [];
$successMessage = $_SESSION['success'] ?? null;
unset($_SESSION['order_id'], $_SESSION['order_total'], $_SESSION['order_items'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Bestelling Bevestigd</title>
</head>

<body>

    <div class="confirmation-container">
        <h1>Bedankt voor je bestelling!</h1>

        <?php if ($successMessage): ?>
            <div class="success-message">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <p>Je bestelling is succesvol geplaatst en wordt zo snel mogelijk bezorgd.</p>
        <p>Je krijgt een bevestiging via e-mail.</p>

        <?php if ($orderId): ?>
            <h2>Bestellingsoverzicht</h2>
            <p><strong>Bestelling ID:</strong> <?= $orderId ?></p>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                </tr>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>€<?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p><strong>Totaalbedrag: €<?= number_format($orderTotal, 2, ',', '.') ?></strong></p>
        <?php endif; ?>

        <a href="/ordering-pizza/" class="button">Terug naar het startpagina</a>
    </div>

</body>

</html>