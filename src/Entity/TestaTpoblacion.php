<?php

namespace App\Entity;

use App\Repository\TestaTpoblacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTpoblacionRepository::class)]
class TestaTpoblacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $des_poblacion = null;

    function __construct() {
        $this->des_poblacion = $des_poblacion;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDesPoblacion(): ?string
    {
        return $this->des_poblacion;
    }

    public function setDesPoblacion(string $des_poblacion): static
    {
        $this->des_poblacion = $des_poblacion;

        return $this;
    }

    public function __toString(){ 
        // to show the name of the Category in the select 
        return $this->des_poblacion; 
    } 
}
