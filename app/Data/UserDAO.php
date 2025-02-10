<?php

declare(strict_types=1);

use App\Models\User;

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

    public function createUser(
        string $firstName,
        string $lastName,
        string $street,
        string $houseNumber,
        string $postalCode,
        string $city,
        ?string $phoneNumber = null,         // optional fields can be null
        string $email,
        string $passwordHash,
        int $promotionEligible = 0,
        ?string $remarks = null,
        ?string $lastLoginEmail = null
    ): bool {
        $sql = "INSERT INTO Users (
                    FirstName,
                    LastName,
                    Street,
                    HouseNumber,
                    PostalCode,
                    City,
                    PhoneNumber,
                    Email,
                    PasswordHash,
                    PromotionEligible,
                    Remarks,
                    LastLoginEmail
                )
                VALUES (
                    :firstName,
                    :lastName,
                    :street,
                    :houseNumber,
                    :postalCode,
                    :city,
                    :phoneNumber,
                    :email,
                    :passwordHash,
                    :promotionEligible,
                    :remarks,
                    :lastLoginEmail
                )";
    
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'firstName'        => $firstName,
            'lastName'         => $lastName,
            'street'           => $street,
            'houseNumber'      => $houseNumber,
            'postalCode'       => $postalCode,
            'city'             => $city,
            'phoneNumber'      => $phoneNumber,
            'email'            => $email,
            'passwordHash'     => $passwordHash,
            'promotionEligible'=> $promotionEligible,
            'remarks'          => $remarks,
            'lastLoginEmail'   => $lastLoginEmail
        ]);
    }
}
?>