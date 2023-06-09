<?php
declare(strict_types=1);

namespace App\Entity;

class User
{
    private ?int $userId;
    private string $firstName;
    private string $secondName;
    private string $email;
    private string $phone;

    public function __construct(?int $userId, string $firstName, string $secondName, string $email, string $phone)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
