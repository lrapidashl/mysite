<?php
declare(strict_types=1);

namespace App\Service;

use App\Controller\Input\RegisterUserInput;
use App\Entity\User;
use App\Entity\UserRole;
use App\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    private PasswordHasher $passwordHasher;

    public function __construct(UserRepository $userRepository, PasswordHasher $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function register(RegisterUserInput $input): int
    {
        $existingUser = $this->userRepository->findByEmail($input->getEmail());
        if ($existingUser !== null)
        {
            throw new \InvalidArgumentException("User with email " . $input->getEmail() . " already has been registered");
        }
        if (!UserRole::isValid($input->getRole()))
        {
            throw new \InvalidArgumentException("Role is not valid " . $input->getRole());
        }

        $user = new User(
            null,
            $input->getEmail(),
            $input->getFirstName(),
            $input->getSecondName(),
            $input->getPhone(),
            $this->passwordHasher->hash($input->getPassword()),
            $input->getRole(),
            null,
            null
        );
        return $this->userRepository->store($user);
    }
}