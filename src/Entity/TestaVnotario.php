<?php

namespace App\Entity;

use App\Repository\TestaVnotarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaVnotarioRepository::class)]
class TestaVnotario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private string $desNotario;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $numTestamento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesNotario(): string
    {
        return $this->desNotario;
    }

    public function setDesNotario(string $desNotario): self
    {
        $this->desNotario = $desNotario;
        return $this;
    }

    public function getNumTestamento(): ?int
    {
        return $this->numTestamento;
    }

    public function setNumTestamento(?int $numTestamento): self
    {
        $this->numTestamento = $numTestamento;
        return $this;
    }
}
