<?php
// views/User/register.php

use app\Helpers\SessionManager;

SessionManager::startSession();

// Haal fout- en succesmeldingen op
$successMessage = $_SESSION['success'] ?? null;
$errorMessage = $_SESSION['error'] ?? ($_GET['error'] ?? null);
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="/ordering-pizza/public/css/style.css">
    <style>
        .error-message {
            background: #ffcccc;
            color: #d62828;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .input-error {
            border: 2px solid #d62828;
            background: #ffcccc;
        }
    </style>
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
                <input type="text" id="first_name" name="first_name" required class="<?= $errorMessage ? 'input-error' : '' ?>">

                <label for="last_name">Achternaam (verplicht):</label>
                <input type="text" id="last_name" name="last_name" required class="<?= $errorMessage ? 'input-error' : '' ?>">
            </fieldset>

            <fieldset>
                <legend>Adresgegevens</legend>
                <label for="street">Straat (verplicht):</label>
                <input type="text" id="street" name="street" required class="<?= $errorMessage ? 'input-error' : '' ?>">

                <label for="house_number">Huisnummer (verplicht):</label>
                <input type="text" id="house_number" name="house_number" required class="<?= $errorMessage ? 'input-error' : '' ?>">

                <label for="postal_code">Postcode (verplicht):</label>
                <input type="text" id="postal_code" name="postal_code" required class="<?= $errorMessage ? 'input-error' : '' ?>">

                <label for="city">Stad (verplicht):</label>
                <input type="text" id="city" name="city" required class="<?= $errorMessage ? 'input-error' : '' ?>">
            </fieldset>

            <fieldset>
                <legend>Contactinformatie</legend>
                <label for="phone_number">Telefoonnummer (optioneel):</label>
                <input type="text" id="phone_number" name="phone_number">

                <label for="email">E-mail (verplicht):</label>
                <input type="email" id="email" name="email" required class="<?= $errorMessage ? 'input-error' : '' ?>">
            </fieldset>

            <fieldset>
                <legend>Beveiliging</legend>
                <label for="password">Wachtwoord (verplicht):</label>
                <input type="password" id="password" name="password" required class="<?= $errorMessage ? 'input-error' : '' ?>">

                <label for="confirm_password">Bevestig Wachtwoord (verplicht):</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="<?= $errorMessage ? 'input-error' : '' ?>">
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