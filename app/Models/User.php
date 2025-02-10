<?php
// app/Models/User.php

namespace app\Models;

class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $street;
    private string $houseNumber;
    private string $postalCode;
    private string $city;
    private ?string $phoneNumber;
    private string $email;
    private string $passwordHash;
    private bool $promotionEligible;
    private ?string $remarks;
    private string $createdAt;

    public function __construct(array $data)
    {
        $this->id = $data['UserID'] ?? 0;
        $this->firstName = $data['FirstName'];
        $this->lastName = $data['LastName'];
        $this->street = $data['Street'];
        $this->houseNumber = $data['HouseNumber'];
        $this->postalCode = $data['PostalCode'];
        $this->city = $data['City'];
        $this->phoneNumber = $data['PhoneNumber'] ?? null;
        $this->email = $data['Email'];
        $this->passwordHash = $data['PasswordHash'];
        $this->promotionEligible = $data['PromotionEligible'] ?? false;
        $this->remarks = $data['Remarks'] ?? null;
        $this->createdAt = $data['CreatedAt'];
    }


    // Getter Methods
    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function isPromotionEligible(): bool
    {
        return $this->promotionEligible;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
?>