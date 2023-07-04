<?php
declare(strict_types=1);

namespace App\Controller\Input;

use App\Entity\UserRole;
use App\Service\Input\RegisterUserInputInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterUserInput extends AbstractType implements RegisterUserInputInterface
{
    private string $firstName;
    private string $secondName;
    private string $email;
    private string $phone;
    private string $password;
    private int $role;
    private ?string $avatarPath;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }

    public function setAvatarPath(string $avatarPath): void
    {
        $this->avatarPath = $avatarPath;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, [
            'attr' => [
                'class' => 'form__input',
                'placeholder' => 'Имя'
                ]
            ])
            ->add('secondName', TextType::class, [
                'attr' => [
                    'class' => 'form__input',
                    'placeholder' => 'Фамилия'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form__input',
                    'placeholder' => 'Email'
                ]
            ])
            ->add('phone', TelType::class, [
                'attr' => [
                    'class' => 'form__input',
                    'placeholder' => 'Телефон'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form__input',
                    'placeholder' => 'Пароль'
                ]
            ])
            ->add('role', ChoiceType::class, [
                'choices'  => [
                    'User' => UserRole::USER,
                    'Admin' => UserRole::ADMIN,
                ],
                'attr' => [
                    'class' => 'form__input',
                ]
            ])
            ->add('register', SubmitType::class, [
                'attr' => [
                    'class' => 'form__submit'
                ]
            ]);
    }
}