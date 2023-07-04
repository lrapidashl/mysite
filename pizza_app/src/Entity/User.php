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
    private string $password;
    private int $role;
    private ?string $avatarPath;
    private ?Image $image;

    public function __construct(
        ?int $userId,
        string $email,
        string $firstName,
        string $secondName,
        string $phone,
        string $password,
        int $role,
        ?string $avatarPath,
        ?Image $image)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->role = $role;
        $this->avatarPath = $avatarPath;
        $this->image = $image;
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }
}
