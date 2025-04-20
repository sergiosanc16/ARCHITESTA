<?php

namespace App\Entity;

use App\Repository\TestaToficioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaToficioRepository::class)]
class TestaToficio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $des_oficio = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDesOficio(): ?string
    {
        return $this->des_oficio;
    }

    public function setDesOficio(string $des_oficio): static
    {
        $this->des_oficio = $des_oficio;

        return $this;
    }
}
