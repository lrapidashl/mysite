<?php
declare(strict_types=1);

namespace App\Entity;

class Image
{
    private ?int $imageId;
    private string $path;

    public function __construct(
        ?int $imageId,
        string $path)
    {
        $this->imageId = $imageId;
        $this->path = $path;
    }

    public function getImageId(): ?int
    {
        return $this->imageId;
    }

    public function getPathimage(): ?string
    {
        return $this->path;
    }
}