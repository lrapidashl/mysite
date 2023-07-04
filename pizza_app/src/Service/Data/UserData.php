<?php
declare(strict_types=1);

namespace App\Service\Data;

class UserData
{
    private ?int $userId;
    private string $firstName;
    private string $secondName;
    private string $email;
    private string $phone;
    private int $role;
    private ?string $avatarPath;

    public function __construct(
        ?int $userId,
        string $email,
        string $firstName,
        string $secondName,
        string $phone,
        int $role,
        ?string $avatarPath)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->avatarPath = $avatarPath;
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

    public function getRole(): int
    {
        return $this->role;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }
}