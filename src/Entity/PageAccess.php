<?php

namespace App\Entity;

use App\Repository\PageAccessRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageAccessRepository::class)]
class PageAccess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_access = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastAccess(): ?\DateTimeInterface
    {
        return $this->last_access;
    }

    public function setLastAccess(\DateTimeInterface $last_access): static
    {
        $this->last_access = $last_access;

        return $this;
    }
}
