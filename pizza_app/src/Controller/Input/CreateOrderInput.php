<?php
declare(strict_types=1);

namespace App\Controller\Input;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOrderInput extends AbstractType
{
    private string $name;
    private string $composition;
    private string $price;
    private string $imagePath;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getComposition(): string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): void
    {
        $this->composition = $composition;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'attr' => [
                'class' => 'form__input',
                'placeholder' => 'Название'
            ]
        ])
            ->add('composition', TextType::class, [
                'attr' => [
                    'class' => 'form__input',
                    'placeholder' => 'Состав'
                ]
            ])
            ->add('price', NumberType::class, [
                'attr' => [
                    'class' => 'form__input',
                    'placeholder' => 'Цена'
                ]
            ])
            ->add('image_path', FileType::class, [
                'attr' => [
                    'class' => 'hidden',
                    'accept' => 'image/png,image/jpeg,image/gif'
                ]
            ])
            ->add('create', SubmitType::class, [
                'attr' => [
                    'class' => 'form__submit'
                ]
            ]);
    }
}