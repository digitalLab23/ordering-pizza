<?php
// app/Data/UserDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\User;
use PDO;

class UserDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function createUser(
        string $firstName,
        string $lastName,
        string $street,
        string $houseNumber,
        string $postalCode,
        string $city,
        ?string $phoneNumber,
        string $email,
        string $passwordHash,
        int $promotionEligible = 0
    ): bool {
        $query = "INSERT INTO Users (FirstName, LastName, Street, HouseNumber, PostalCode, City, PhoneNumber, Email, PasswordHash, PromotionEligible)
                  VALUES (:firstName, :lastName, :street, :houseNumber, :postalCode, :city, :phoneNumber, :email, :passwordHash, :promotionEligible)";
        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'street' => $street,
            'houseNumber' => $houseNumber,
            'postalCode' => $postalCode,
            'city' => $city,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'passwordHash' => $passwordHash,
            'promotionEligible' => $promotionEligible
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        $query = "SELECT * FROM Users WHERE Email = :email";
        $statement = $this->connection->prepare($query);
        $statement->execute(['email' => $email]);
        $result = $statement->fetch();

        return $result ? new User($result) : null;
    }
    public function emailExists(string $email): bool
    {
        $query = "SELECT COUNT(*) FROM Users WHERE Email = :email";
        $statement = $this->connection->prepare($query);
        $statement->execute(['email' => $email]);
        return $statement->fetchColumn() > 0;
    }
}
