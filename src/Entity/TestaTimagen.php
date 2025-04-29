<?php

namespace App\Entity;

use App\Repository\TestaTimagenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTimagenRepository::class)]
class TestaTimagen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $des_imagen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDesImagen(): ?string
    {
        return $this->des_imagen;
    }

    public function setDesImagen(string $des_imagen): static
    {
        $this->des_imagen = $des_imagen;

        return $this;
    }
    public function __toString(){ 

        // to show the name of the Category in the select 

        return $this->des_imagen; 
    } 

}
