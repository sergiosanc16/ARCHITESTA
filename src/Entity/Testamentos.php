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
    private ?bool $murcia = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGrantor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $oficio = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoDoc = null;

    #[ORM\Column]
    private ?bool $relacion = null;

    #[ORM\Column(length: 255)]
    private ?string $notario = null;

    #[ORM\Column]
    private ?int $numProtocol = null;

    #[ORM\Column]
    private ?int $numFolio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $segGrantor = null;

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
        return $this->murcia;
    }

    public function setMurcia(bool $murcia): static
    {
        $this->murcia = $murcia;

        return $this;
    }

    public function getNomGrantor(): ?string
    {
        return $this->nomGrantor;
    }

    public function setNomGrantor(string $nomGrantor): static
    {
        $this->nomGrantor = $nomGrantor;

        return $this;
    }

    public function getOficio(): ?string
    {
        return $this->oficio;
    }

    public function setOficio(?string $oficio): static
    {
        $this->oficio = $oficio;

        return $this;
    }

    public function getTipoDoc(): ?string
    {
        return $this->tipoDoc;
    }

    public function setTipoDoc(string $tipoDoc): static
    {
        $this->tipoDoc = $tipoDoc;

        return $this;
    }

    public function isRelacion(): ?bool
    {
        return $this->relacion;
    }

    public function setRelacion(bool $relacion): static
    {
        $this->relacion = $relacion;

        return $this;
    }

    public function getNotario(): ?string
    {
        return $this->notario;
    }

    public function setNotario(string $notario): static
    {
        $this->notario = $notario;

        return $this;
    }

    public function getNumProtocol(): ?int
    {
        return $this->numProtocol;
    }

    public function setNumProtocol(int $numProtocol): static
    {
        $this->numProtocol = $numProtocol;

        return $this;
    }

    public function getNumFolio(): ?int
    {
        return $this->numFolio;
    }

    public function setNumFolio(int $numFolio): static
    {
        $this->numFolio = $numFolio;

        return $this;
    }

    public function getSegGrantor(): ?string
    {
        return $this->segGrantor;
    }

    public function setSegGrantor(?string $segGrantor): static
    {
        $this->segGrantor = $segGrantor;

        return $this;
    }
}
