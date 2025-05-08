<?php

namespace App\Entity;

use App\Repository\TestaVimagenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaVimagenRepository::class)]
#[ORM\Table(name: 'testa_vimagen')]
class TestaVimagen
{
    #[ORM\Id]
    #[ORM\Column(name: 'ID', type: 'integer', options: ['default' => 0])]
    private int $id;

    #[ORM\Column(name: 'des_imagen', type: 'string', length: 100)]
    private string $desImagen;

    #[ORM\Column(name: 'num_testamento', type: 'integer', nullable: true)]
    private ?int $numTestamento = null;

    // Getters y Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDesImagen(): string
    {
        return $this->desImagen;
    }

    public function setDesImagen(string $desImagen): self
    {
        $this->desImagen = $desImagen;
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
