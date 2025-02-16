<?php
// views/home/index.php
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/public/css/style.css">
    <title>Home</title>
</head>

<body>

    <div class="home-container">
        <h1>Welkom bij onze pizzeria!</h1>
        <p>Bestel eenvoudig en snel je favoriete pizza online.</p>

        <nav>
            <a class="button" href="menu">Bekijk ons menu</a>
            <a class="button" href="cart">Bekijk je winkelmandje</a>
        </nav>

        <p>
            <a href="user/register">Registreren</a> |
            <a href="user/login">Inloggen</a>
        </p>
    </div>

</body>

</html>