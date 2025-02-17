<?php
// app/Helpers/SessionManager.php

namespace app\Helpers;

class SessionManager
{
    public static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function logout(): void
    {
        // Controleer of een sessie actief is voordat we deze vernietigen
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = []; // Leeg de sessie-variabelen

            // Sessie vernietigen
            session_unset();
            session_destroy();
            session_write_close();
            session_regenerate_id(true);
        }

        // Verwijder 'Onthoud mij' cookie indien aanwezig
        if (isset($_COOKIE['user_email'])) {
            setcookie('user_email', '', time() - 3600, "/");
        }
    }
}
