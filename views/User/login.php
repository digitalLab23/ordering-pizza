<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/public/css/style.css">
    <title>Login</title>
</head>

<body>

    <div class="auth-container">
        <h1>Login</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="login" method="POST">
            <label for="email">Email:</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Voer je email in"
                required>

            <label for="password">Wachtwoord:</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Voer je wachtwoord in"
                required>

            <button type="submit">Inloggen</button>
        </form>

        <p>
            Nog geen account?
            <a href="register">Registreer hier</a>
        </p>

        <a class="button back-home" href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] ?>/ordering-pizza/">Terug naar Home</a>
    </div>

</body>

</html>