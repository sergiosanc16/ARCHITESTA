<?php

namespace App\Entity;

use App\Repository\TestaTValidacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTValidacionRepository::class)]
class TestaTValidacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?TestaTtestamento $id_testamento = null;

    #[ORM\Column]
    private ?int $num_validacion = null;

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
}
