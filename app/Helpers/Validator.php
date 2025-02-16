<?php
// app/Helpers/Validator.php

namespace app\Helpers;

class Validator
{
    public static function validateRegistration(string $firstName, string $lastName, string $email, string $password, string $confirmPassword): bool
    {
        return !empty($firstName) && !empty($lastName) &&
            filter_var($email, FILTER_VALIDATE_EMAIL) &&
            $password === $confirmPassword && strlen($password) >= 6;
    }
}
