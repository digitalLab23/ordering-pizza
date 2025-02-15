<?php
// app/Business/UserService.php

namespace App\Business;

use app\Data\UserDAO;
use app\Models\User;

class UserService
{
    private UserDAO $userDAO;

    public function __construct()
    {
        // 1. Instantiate the DAO
        $this->userDAO = new UserDAO();
    }

    public function getAllUsers(): array
    {
        try {
            $users = $this->userDAO->findAll();
            return is_array($users) ? $users : [];
        } catch (\Exception $e) {
            // Log the error if needed
            return [];
        }
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userDAO->findById($userId);
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
        // Add business logic validations here
        // (e.g., check if email already exists).
        
        // Then delegate to DAO
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
        // Potentially some business logic (e.g., checking constraints)
        return $this->userDAO->update($user);
    }

    public function deleteUser(int $userId): bool
    {
        return $this->userDAO->delete($userId);
    }
}