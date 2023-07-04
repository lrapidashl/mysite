<?php
declare(strict_types=1);

namespace App\Security;

use App\Entity\UserRole;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    private int $userId;
    private string $email;
    private string $password;
    private int $role;

    public function __construct(int $userId, string $email, string $password, int $role)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        if ($this->role === UserRole::ADMIN)
        {
            return ['ROLE_ADMIN', 'ROLE_USER'];
        }
        return ['ROLE_USER'];
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getSalt()
    {
        return null;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function eraseCredentials()
    {

    }
}