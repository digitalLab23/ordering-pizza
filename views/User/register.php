<?php
// views/User/register.php

// Start de sessie als deze nog niet gestart is
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Haal fout- en succesberichten op
$successMessage = $_SESSION['success'] ?? null;
$errorMessage = $_SESSION['error'] ?? ($_GET['error'] ?? null);

// Verwijder sessieberichten na weergave
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="/ordering-pizza/public/css/style.css">
</head>

<body>

    <div class="auth-container">
        <h2>Registreren</h2>

        <?php if ($successMessage): ?>
            <div class="success-message">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="error-message">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <form action="/ordering-pizza/user/register" method="POST">
            <fieldset>
                <legend>Persoonlijke Gegevens</legend>
                <label for="first_name">Voornaam (verplicht):</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Achternaam (verplicht):</label>
                <input type="text" id="last_name" name="last_name" required>
            </fieldset>

            <fieldset>
                <legend>Adresgegevens</legend>
                <label for="street">Straat (verplicht):</label>
                <input type="text" id="street" name="street" required>

                <label for="house_number">Huisnummer (verplicht):</label>
                <input type="text" id="house_number" name="house_number" required>

                <label for="postal_code">Postcode (verplicht):</label>
                <input type="text" id="postal_code" name="postal_code" required>

                <label for="city">Stad (verplicht):</label>
                <input type="text" id="city" name="city" required>
            </fieldset>

            <fieldset>
                <legend>Contactinformatie</legend>
                <label for="phone_number">Telefoonnummer (optioneel):</label>
                <input type="text" id="phone_number" name="phone_number">

                <label for="email">E-mail (verplicht):</label>
                <input type="email" id="email" name="email" required>
            </fieldset>

            <fieldset>
                <legend>Beveiliging</legend>
                <label for="password">Wachtwoord (verplicht):</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Bevestig Wachtwoord (verplicht):</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </fieldset>

            <label for="promotion_eligible">
                <input type="checkbox" id="promotion_eligible" name="promotion_eligible" value="1">
                Ik wil promoties ontvangen (optioneel)
            </label>

            <button type="submit">Registreren</button>
        </form>

        <p>Heb je al een account? <a href="/ordering-pizza/user/login">Log hier in</a></p>
    </div>

</body>

</html>