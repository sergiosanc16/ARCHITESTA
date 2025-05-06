<?php

namespace App\Entity;

use App\Repository\TestaTValidacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTValidacionRepository::class)]
class TestaTValidacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_testamento', referencedColumnName: 'id')]
    private ?TestaTtestamento $id_testamento = null;

    #[ORM\Column]
    private ?int $num_validacion = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $validaciones = [];

    function __construct(TestaTtestamento $id_testamento) {
        $this->id_testamento = $id_testamento;
        $this->num_validacion = 0;
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

    public function getIdTestamento(): ?TestaTtestamento
    {
        return $this->id_testamento;
    }

    public function setIdTestamento(TestaTtestamento $id_testamento): static
    {
        $this->id_testamento = $id_testamento;

        return $this;
    }

    public function getNumValidacion(): ?int
    {
        return $this->num_validacion;
    }

    public function setNumValidacion(int $num_validacion): static
    {
        $this->num_validacion = $num_validacion;

        return $this;
    }

    public function getValidaciones(): array
    {
        return $this->validaciones;
    }

    public function setValidaciones(array $validaciones): static
    {
        $this->validaciones = $validaciones;

        return $this;
    }
}
