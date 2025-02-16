<?php
// views/Order/checkout.php
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>checkout</title>
</head>
<h1>Afrekenen</h1>

<form method="POST">
    <label>Naam:</label>
    <input type="text" name="name" required>

    <label>Adres:</label>
    <input type="text" name="address" required>

    <label>Postcode:</label>
    <input type="text" name="postal_code" required>

    <label>Stad:</label>
    <input type="text" name="city" required>

    <label>Extra instructies:</label>
    <textarea name="instructions"></textarea>

    <button type="submit">Bestelling plaatsen</button>
</form>

<a href="/cart">Terug naar winkelmandje</a>