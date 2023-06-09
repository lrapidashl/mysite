<?php
declare(strict_types=1);

namespace App\Entity;

class Order
{
    private ?int $orderId;
    private string $name;
    private string $composition;
    private int $price;
    private string $imgPath;

    public function __construct(?int $orderId, string $name, string $composition, int $price, string $imgPath)
    {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->composition = $composition;
        $this->price = $price;
        $this->imgPath = $imgPath;
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

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getImgPath(): string
    {
        return $this->imgPath;
    }
}
