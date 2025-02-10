<?php
// app/AppConfig.php

namespace app;

class AppConfig
{
    // Algemene configuratie
    public const BASE_URL = 'http://localhost/Eindopdracht_Pizzeria';
    public const ENVIRONMENT = 'development'; // development of production

    // Database configuratie
    public const DB_HOST = 'localhost';
    public const DB_NAME = 'Pizzeria';
    public const DB_USER = 'root';
    public const DB_PASSWORD = '';

    // Algemene instellingen
    public const ITEMS_PER_PAGE = 10; // Voor paginatie
    public const CURRENCY = '€'; // Valuta symbool
    public const TAX_RATE = 0.21; // 21% btw

    // Beveiliging
    public const HASH_ALGORITHM = PASSWORD_BCRYPT; // Algoritme voor wachtwoord hashing
    public const COOKIE_LIFETIME = 86400; // 1 dag (in seconden)
    public const SESSION_LIFETIME = 3600; // 1 uur (in seconden)

    // Debug instellingen
    public static function isDebugMode(): bool
    {
        return self::ENVIRONMENT === 'development';
    }
}
