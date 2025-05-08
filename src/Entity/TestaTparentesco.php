<?php

namespace App\Entity;

use App\Repository\TestaTparentescoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTparentescoRepository::class)]
class TestaTparentesco
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $des_parentesco = null;

    function __construct(string $des_parentesco) {
        $this->des_parentesco = $des_parentesco;
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

    public function getDesParentesco(): ?string
    {
        return $this->des_parentesco;
    }

    public function setDesParentesco(string $des_parentesco): static
    {
        $this->des_parentesco = $des_parentesco;

        return $this;
    }
    public function __toString(){ 
        // to show the name of the Category in the select 
        return $this->des_parentesco; 
        // to show the id of the Category in the select 
        // return $this->id; 
    }         
}
