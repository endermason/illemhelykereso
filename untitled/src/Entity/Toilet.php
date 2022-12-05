<?php

namespace App\Entity;

use App\Repository\ToiletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ToiletRepository::class)]
class Toilet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $Type;

    #[ORM\Column(length: 255)]
    private string $Address;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $GpsCoordinates = [];

    #[ORM\Column]
    private int $Price;

    #[ORM\Column(length: 255)]
    private string $OpeningTimes;

    #[ORM\Column]
    private bool $IsAccessible;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Comments = null;

    #[ORM\Column]
    private bool $Isaccepted;

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getGpsCoordinates(): array
    {
        return $this->GpsCoordinates;
    }

    public function setGpsCoordinates(array $GpsCoordinates): self
    {
        $this->GpsCoordinates = $GpsCoordinates;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getOpeningTimes(): string
    {
        return $this->OpeningTimes;
    }

    public function setOpeningTimes(string $OpeningTimes): self
    {
        $this->OpeningTimes = $OpeningTimes;

        return $this;
    }

    public function isIsAccessible(): bool
    {
        return $this->IsAccessible;
    }

    public function setIsAccessible(bool $IsAccessible): self
    {
        $this->IsAccessible = $IsAccessible;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->Comments;
    }

    public function setComments(?string $Comments): self
    {
        $this->Comments = $Comments;

        return $this;
    }

    public function isIsaccepted(): bool
    {
        return $this->Isaccepted;
    }

    public function setIsaccepted(bool $Isaccepted): self
    {
        $this->Isaccepted = $Isaccepted;

        return $this;
    }
}
