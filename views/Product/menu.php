<?php
// views/Product/menu.php

use Config\AppConfig;
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ons Menu - Pizzeria</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <header>
        <h1>Ons Menu</h1>
    </header>

    <main class="container">
        <?php if (empty($products)): ?>
            <p>Er zijn momenteel geen producten beschikbaar.</p>
        <?php else: ?>
            <div class="menu-grid">
                <?php foreach ($products as $product): ?>
                    <div class="menu-item">
                        <h3><?= htmlspecialchars($product->name) ?></h3>
                        <p class="price"><?= AppConfig::CURRENCY . number_format($product->price, 2) ?></p>
                        <a href="/ordering-pizza/product/<?= $product->id ?>" class="order-button">Bestellen</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="home" class="button" style="margin-top: 40px;">Terug naar Home</a>
    </main>

</body>

</html>