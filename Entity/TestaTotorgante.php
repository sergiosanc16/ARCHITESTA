<?php

namespace App\Entity;

use App\Repository\TestaTotorganteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTotorganteRepository::class)]
class TestaTotorgante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $apellido1 = null;

    #[ORM\Column(length: 100)]
    private ?string $apellido2 = null;

    #[ORM\ManyToOne(targetEntity: TestaToficio::class)]
    #[ORM\JoinColumn(name: 'id_oficio', referencedColumnName: 'id', nullable: false)]
    private ?TestaToficio $id_oficio = null;


    #[ORM\ManyToOne(targetEntity: TestaTparentesco::class)]
    #[ORM\JoinColumn(name: 'id_parentesco', referencedColumnName: 'id', nullable: true)]
    private ?TestaTparentesco $parentesco = null;

    function __construct(string $nombre, string $apellido1, string $apellido2, TestaToficio $id_oficio, TestaTparentesco $parentesco) {
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->id_oficio = $id_oficio;

        $this->parentesco = $parentesco;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }
    public function setApellido1(string $apellido1): static
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }
    public function setApellido2(string $apellido2): static
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getIdOficio(): ?TestaToficio
    {
        return $this->id_oficio;
    }
    public function setIdOficio(TestaToficio $id_oficio): static
    {
        $this->id_oficio = $id_oficio;

        return $this;
    }

    public function getParentesco(): ?TestaTparentesco 
    { 
        return $this->parentesco;
    }
    public function setParentesco(?TestaTparentesco $parentesco): self 
    { 
        $this->parentesco = $parentesco;
        return $this;
    }

    public function __toString(){ 
        // to show the name of the Category in the select 
        return $this->nombre.' '.$this->apellido1.' '.$this->apellido2; 
    }  
}
