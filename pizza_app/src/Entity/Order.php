<?php
declare(strict_types=1);

namespace App\Entity;

class Order
{
    private ?int $orderId;
    private string $name;
    private string $composition;
    private string $price;
    private string $imgPath;
    private Image $image;
    private ?int $author;

    public function __construct(?int $orderId, string $name, string $composition, string $price, string $imgPath, ?int $author)
    {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->composition = $composition;
        $this->price = $price;
        $this->imgPath = $imgPath;
        $this->author = $author;
    }

    public function getOrderId(): ?int
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

    public function getImgPath(): string
    {
        return $this->imgPath;
    }

    public function getAuthor(): ?int
    {
        return $this->author;
    }
}
