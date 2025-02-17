<?php
// app/Business/UserService.php

namespace app\Business;

use app\Data\UserDAO;
use app\Models\User;
use Exception;

class UserService
{
    private UserDAO $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userDAO->findByEmail($email);
    }

    public function emailExists(string $email): bool
    {
        return $this->userDAO->emailExists($email);
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
            if ($this->userDAO->emailExists($email)) {
                error_log("E-mail $email bestaat al in de database.");
                return false;
            }

            return $this->userDAO->createUser(
                $firstName,
                $lastName,
                $street,
                $houseNumber,
                $postalCode,
                $city,
                $phoneNumber,
                $email,
                $passwordHash,
                $promotionEligible
            );
        } catch (Exception $e) {
            error_log("Fout bij aanmaken gebruiker $email: " . $e->getMessage());
            return false;
        }
    }

    public function updateUser(User $user): bool
    {
        return $this->userDAO->update($user);
    }

    public function deleteUser(int $userId): bool
    {
        return $this->userDAO->delete($userId);
    }
}
