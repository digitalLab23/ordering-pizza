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
        session_unset();
        session_destroy();
    }
}
