<?php
// app/Data/UserDAO.php

namespace app\Data;

use Config\DbConfig;
use app\Models\User;
use PDO;
use Exception;

class UserDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DbConfig::getInstance()->getConnection();
    }

    public function findByEmail(string $email): ?User
    {
        try {
            $query = "SELECT * FROM Users WHERE Email = :email";
            $statement = $this->connection->prepare($query);
            $statement->execute(['email' => $email]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new User($result) : null;
        } catch (Exception $e) {
            error_log("Fout bij ophalen gebruiker met e-mail $email: " . $e->getMessage());
            return null;
        }
    }

    public function emailExists(string $email): bool
    {
        try {
            $query = "SELECT COUNT(*) FROM Users WHERE Email = :email";
            $statement = $this->connection->prepare($query);
            $statement->execute(['email' => $email]);
            return $statement->fetchColumn() > 0;
        } catch (Exception $e) {
            error_log("Fout bij controleren of e-mail $email bestaat: " . $e->getMessage());
            return false;
        }
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
        try {
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
        } catch (Exception $e) {
            error_log("Fout bij aanmaken gebruiker $email: " . $e->getMessage());
            return false;
        }
    }


    public function update(User $user): bool
    {
        try {
            $query = "UPDATE Users SET 
                      FirstName = :firstName, 
                      LastName = :lastName, 
                      Street = :street, 
                      HouseNumber = :houseNumber, 
                      PostalCode = :postalCode, 
                      City = :city, 
                      PhoneNumber = :phoneNumber, 
                      Email = :email, 
                      PromotionEligible = :promotionEligible
                      WHERE UserID = :userId";

            $statement = $this->connection->prepare($query);

            return $statement->execute([
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'street' => $user->getStreet(),
                'houseNumber' => $user->getHouseNumber(),
                'postalCode' => $user->getPostalCode(),
                'city' => $user->getCity(),
                'phoneNumber' => $user->getPhoneNumber(),
                'email' => $user->getEmail(),
                'promotionEligible' => $user->isPromotionEligible() ? 1 : 0,
                'userId' => $user->getId()
            ]);
        } catch (Exception $e) {
            error_log("Fout bij updaten gebruiker ID " . $user->getId() . ": " . $e->getMessage());
            return false;
        }
    }

    public function delete(int $userId): bool
    {
        try {
            $query = "DELETE FROM Users WHERE UserID = :userId";
            $statement = $this->connection->prepare($query);
            return $statement->execute(['userId' => $userId]);
        } catch (Exception $e) {
            error_log("Fout bij verwijderen gebruiker ID $userId: " . $e->getMessage());
            return false;
        }
    }
}
