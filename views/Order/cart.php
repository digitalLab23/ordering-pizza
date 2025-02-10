<?php
// views/Order/cart.php
?>

<h1>Winkelmandje</h1>

<?php if (empty($cart)): ?>
    <p>Je winkelmandje is leeg.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Product</th>
            <th>Aantal</th>
            <th>Prijs</th>
            <th>Actie</th>
        </tr>
        <?php foreach ($cart as $productId => $quantity): ?>
            <tr>
                <td>Product <?= htmlspecialchars($productId) ?></td> <!-- Productnaam ophalen in productie -->
                <td><?= $quantity ?></td>
                <td>€ <?= number_format(10.00 * $quantity, 2) ?> <!-- Placeholder prijs van €10.00 per item --></td>
                <td>
                    <a href="/cart/remove/<?= $productId ?>">Verwijder</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><strong>Totaalprijs: € <?= number_format(\App\Helpers\PriceCalculator::calculateTotal($cart), 2) ?></strong></p>
    <a href="/checkout">Ga naar afrekenen</a>
<?php endif; ?>

<a href="/menu">Verder winkelen</a>