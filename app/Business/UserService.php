<?php
// app/Business/UserService.php

namespace App\Business;

use App\Data\UserDAO;
use App\Models\User;

class UserService
{
    private UserDAO $userDAO;

    public function __construct()
    {
        // 1. Instantiate the DAO (or inject it via constructor if you prefer)
        $this->userDAO = new UserDAO();
    }

    /**
     * Example: Retrieve a list of all users.
     * (If you want pagination, filtering, etc., pass in the necessary parameters.)
     */
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

    /**
     * Example: Fetch one user by ID
     */
    public function getUserById(int $userId): ?User
    {
        return $this->userDAO->findById($userId);
    }

    /**
     * Example: Register or create a new user
     * Adjust parameters to match your table columns
     */
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
        // plus any optional fields if needed
    ): bool {
        // You could add business logic validations here
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

    /**
     * Example: Update user details (if needed)
     */
    public function updateUser(User $user): bool
    {
        // Potentially some business logic (e.g., checking constraints)
        return $this->userDAO->update($user);
    }

    /**
     * Example: Delete a user by ID
     */
    public function deleteUser(int $userId): bool
    {
        return $this->userDAO->delete($userId);
    }
}