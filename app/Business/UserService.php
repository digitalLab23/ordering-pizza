<?php
// app/Business/UserService.php

namespace app\Business;

use app\Data\UserDAO;
use app\Models\User;

class UserService
{
    private UserDAO $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function getAllUsers(): array
    {
        try {
            return $this->userDAO->findAll() ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userDAO->findById($userId);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userDAO->findByEmail($email);
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
        if ($this->userDAO->emailExists($email)) {
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
