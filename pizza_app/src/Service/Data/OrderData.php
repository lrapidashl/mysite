<?php
declare(strict_types=1);

namespace App\Service\Data;

class OrderData
{
    private int $orderId;
    private string $name;
    private string $composition;
    private string $price;
    private string $imagePath;
    private ?int $author;

    public function __construct(int $orderId, string $name, string $composition, string $price, string $imagePath,  ?int $author)
    {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->composition = $composition;
        $this->price = $price;
        $this->imagePath = $imagePath;
        $this->author = $author;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getComposition(): string
    {
        return $this->composition;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function getAuthor(): ?int
    {
        return $this->author;
    }
}
