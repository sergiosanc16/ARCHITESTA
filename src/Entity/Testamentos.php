<?php

namespace App\Entity;

use App\Repository\TestamentosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestamentosRepository::class)]
class Testamentos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $fecha = null;

    #[ORM\Column]
    private ?bool $Murcia = null;

    #[ORM\Column(length: 255)]
    private ?string $NomGrantor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Oficio = null;

    #[ORM\Column]
    private ?bool $Relacion = null;

    #[ORM\Column(length: 255)]
    private ?string $TipoDoc = null;

    #[ORM\Column(length: 255)]
    private ?string $Notario = null;

    #[ORM\Column]
    private ?int $NumProtocol = null;

    #[ORM\Column]
    private ?int $NumFolio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SegGrantor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFecha(): ?\DateTimeImmutable
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeImmutable $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function isMurcia(): ?bool
    {
        return $this->Murcia;
    }

    public function setMurcia(bool $Murcia): static
    {
        $this->Murcia = $Murcia;

        return $this;
    }

    public function getNomGrantor(): ?string
    {
        return $this->NomGrantor;
    }

    public function setNomGrantor(string $NomGrantor): static
    {
        $this->NomGrantor = $NomGrantor;

        return $this;
    }

    public function getOficio(): ?string
    {
        return $this->Oficio;
    }

    public function setOficio(?string $Oficio): static
    {
        $this->Oficio = $Oficio;

        return $this;
    }

    public function isRelacion(): ?bool
    {
        return $this->Relacion;
    }

    public function setRelacion(bool $Relacion): static
    {
        $this->Relacion = $Relacion;

        return $this;
    }

    public function getTipoDoc(): ?string
    {
        return $this->TipoDoc;
    }

    public function setTipoDoc(string $TipoDoc): static
    {
        $this->TipoDoc = $TipoDoc;

        return $this;
    }

    public function getNotario(): ?string
    {
        return $this->Notario;
    }

    public function setNotario(string $Notario): static
    {
        $this->Notario = $Notario;

        return $this;
    }

    public function getNumProtocol(): ?int
    {
        return $this->NumProtocol;
    }

    public function setNumProtocol(int $NumProtocol): static
    {
        $this->NumProtocol = $NumProtocol;

        return $this;
    }

    public function getNumFolio(): ?int
    {
        return $this->NumFolio;
    }

    public function setNumFolio(int $NumFolio): static
    {
        $this->NumFolio = $NumFolio;

        return $this;
    }

    public function getSegGrantor(): ?string
    {
        return $this->SegGrantor;
    }

    public function setSegGrantor(?string $SegGrantor): static
    {
        $this->SegGrantor = $SegGrantor;

        return $this;
    }
}
