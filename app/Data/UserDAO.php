<?php

declare(strict_types=1);

namespace app\Data;

use app\Config\DbConfig;
use app\Models\User;
use PDO;

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

        //Fetch all users from the database
    public function findAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($result as $row) {
            $users[] = new User(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['password']  // Adjust fields as needed
            );
        }
        return $users;
    }

        //Fetch a user by their ID
    public function findById(int $userId): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User(
                $result['id'],
                $result['first_name'],
                $result['last_name'],
                $result['email'],
                $result['password']  // Adjust fields based on your User model
            );
        }

        return null; // Return null if no user is found
    }

        //Update an existing user in the database.
    public function update(User $user): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE users
            SET 
                first_name = :first_name,
                last_name = :last_name,
                street = :street,
                house_number = :house_number,
                postal_code = :postal_code,
                city = :city,
                phone_number = :phone_number,
                email = :email,
                password = :password,
                promotion_eligible = :promotion_eligible
            WHERE id = :id
        ");

        return $stmt->execute([
            ':first_name'        => $user->getFirstName(),
            ':last_name'         => $user->getLastName(),
            ':street'            => $user->getStreet(),
            ':house_number'      => $user->getHouseNumber(),
            ':postal_code'       => $user->getPostalCode(),
            ':city'              => $user->getCity(),
            ':phone_number'      => $user->getPhoneNumber(),
            ':email'             => $user->getEmail(),
            ':password'            => $user->getPasswordHash(),
            ':promotion_eligible' => $user->isPromotionEligible(),
            ':id'                => $user->getId()
        ]);
    }

        //Delete a user by their ID
    public function delete(int $userId): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>