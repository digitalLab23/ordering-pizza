<?php
// app/Helpers/Validator.php

namespace app\Helpers;

class Validator
{
    public static function validateRegistration(string $firstName, string $lastName, string $email, string $password, string $confirmPassword): array
    {
        $errors = [];

        // Controleer of velden niet leeg zijn
        if (empty($firstName)) {
            $errors[] = "Voornaam is verplicht.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $firstName)) {
            $errors[] = "Voornaam mag alleen letters bevatten.";
        }

        if (empty($lastName)) {
            $errors[] = "Achternaam is verplicht.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lastName)) {
            $errors[] = "Achternaam mag alleen letters bevatten.";
        }

        // E-mailvalidatie
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Ongeldig e-mailadres.";
        }

        // Wachtwoordvalidatie
        if (strlen($password) < 6) {
            $errors[] = "Wachtwoord moet minimaal 6 tekens bevatten.";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Wachtwoord moet minstens één hoofdletter bevatten.";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $errors[] = "Wachtwoord moet minstens één cijfer bevatten.";
        } elseif (!preg_match("/[\W]/", $password)) {
            $errors[] = "Wachtwoord moet minstens één speciaal teken bevatten.";
        }

        // Controleer of wachtwoorden overeenkomen
        if ($password !== $confirmPassword) {
            $errors[] = "Wachtwoorden komen niet overeen.";
        }

        return $errors;
    }
}
