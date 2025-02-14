<?php
// views/Product/menu.php

use Config\AppConfig;

?>

<h1>Ons Menu</h1>

<?php if (empty($products)): ?>
    <p>Er zijn momenteel geen producten beschikbaar.</p>
<?php else: ?>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <a href="/product/<?= $product->id ?>">
                    <?= htmlspecialchars($product->name) ?> - <?= AppConfig::CURRENCY . number_format($product->price, 2) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<a href="home">Terug naar Home</a>
