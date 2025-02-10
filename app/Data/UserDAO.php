<?php

declare(strict_types=1);

use app\Models\User;

require_once __DIR__ . '/../../config/DbConfig.php';
require_once __DIR__ . '/../Models/User.php';

class UserDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $db = DbConfig::getInstance();
        $this->pdo = $db->getConnection();
    }

    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM Users WHERE Email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User([
                'UserID' => $userData['UserID'] ?? 0,
                'FirstName' => $userData['FirstName'] ?? '',
                'LastName' => $userData['LastName'] ?? '',
                'Street' => $userData['Street'] ?? '',
                'HouseNumber' => $userData['HouseNumber'] ?? '',
                'PostalCode' => $userData['PostalCode'] ?? '',
                'City' => $userData['City'] ?? '',
                'PhoneNumber' => $userData['PhoneNumber'] ?? null,
                'Email' => $userData['Email'] ?? '',
                'PasswordHash' => $userData['PasswordHash'] ?? '',
                'PromotionEligible' => $userData['PromotionEligible'] ?? false,
                'Remarks' => $userData['Remarks'] ?? null,
                'CreatedAt' => $userData['CreatedAt'] ?? date('Y-m-d H:i:s')
            ]);
        }
        return null;
    }

    public function createUser(string $firstName, string $lastName, string $email, string $passwordHash): bool
    {
        $sql = "INSERT INTO Users (FirstName, LastName, Email, PasswordHash) 
                VALUES (:firstName, :lastName, :email, :passwordHash)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'passwordHash' => $passwordHash
        ]);
    }
}
?>