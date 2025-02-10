<?php
// app/config/DbConfig.php

namespace app\Config;

use PDO;
use PDOException;

class DbConfig
{
    private static ?DbConfig $instance = null;
    private PDO $connection;

    private string $host = 'localhost';
    private string $dbName = 'Pizzeria';
    private string $username = 'root';
    private string $password = '';

    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log de fout voor debugging (indien nodig)
            die("Fout bij databaseverbinding: " . $e->getMessage());
        }
    }

    public static function getInstance(): DbConfig
    {
        if (self::$instance === null) {
            self::$instance = new DbConfig();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
?>