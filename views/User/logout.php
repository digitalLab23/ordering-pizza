<?php
// views/User/logout.php

// Start de sessie als deze nog niet gestart is
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sessie beëindigen
session_unset();
session_destroy();

// Verwijder 'Onthoud mij' cookie indien aanwezig
setcookie('user_email', '', time() - 3600, "/");

// Redirect naar de loginpagina met een succesbericht
header("Location: /ordering-pizza/user/login?message=Je+bent+succesvol+uitgelogd.");
exit;
