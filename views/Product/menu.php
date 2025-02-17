<?php
// views/Product/menu.php

use app\Helpers\SessionManager;

SessionManager::startSession();

// Controleer of er producten in het winkelmandje zitten
$cartTotal = $_SESSION['cart_total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ordering-pizza/public/css/style.css">
    <title>Menu</title>
    <style>
        .menu-container {
            max-width: 1140px;
            margin: 0 auto;
            text-align: center;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 20px;
            justify-items: center;
        }

        .menu-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            width: 100%;
            max-width: 250px;
            text-align: center;
        }

        .menu-item:hover {
            transform: scale(1.05);
        }

        .menu-item h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .menu-item .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #e63946;
        }

        .nav-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .button {
            background-color: #e63946;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            background-color: #d62828;
        }
    </style>
</head>

<body>

    <div class="menu-container">
        <h1>Ons Menu</h1>

        <div class="cart-summary">
            <a href="/ordering-pizza/cart" class="button">
                Winkelwagen (€<?= number_format($cartTotal, 2, ',', '.') ?>)
            </a>
        </div>

        <div class="menu-grid">
            <?php foreach ($products as $product): ?>
                <div class="menu-item">
                    <h3><?= htmlspecialchars($product->getName()) ?></h3>
                    <p><?= htmlspecialchars($product->getComposition() ?? 'Geen omschrijving beschikbaar') ?></p>
                    <p class="price">€<?= number_format($product->getPrice(), 2, ',', '.') ?></p>

                    <form action="/ordering-pizza/cart/add" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                        <input type="number" name="quantity" value="1" min="1" required>
                        <button type="submit">Bestellen</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="nav-buttons">
            <a href="/ordering-pizza/" class="button">Terug naar startpagina</a>
        </div>

    </div>

</body>

</html>