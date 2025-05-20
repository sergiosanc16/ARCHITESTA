<?php

namespace App\Entity;

use App\Repository\TestaTtestaotorganteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTtestaotorganteRepository::class)]
#[ORM\Table(name: 'testa_ttestaotorgante')]
class TestaTtestaotorgante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: TestaTtestamento::class)]
    #[ORM\JoinColumn(name: 'ID_TESTAMENTO', referencedColumnName: 'id', nullable: false)]
    private ?TestaTtestamento $testamento = null;

    #[ORM\ManyToOne(targetEntity: TestaTotorgante::class)]
    #[ORM\JoinColumn(name: 'ID_OTORGANTE', referencedColumnName: 'id', nullable: false)]
    private ?TestaTotorgante $otorgante = null;

    #[ORM\Column(type: 'smallint', options: ['unsigned' => true, 'default' => 1])]
    private int $num_orden = 0;

    function __construct(TestaTtestamento $testamento, TestaTotorgante $otorgante, int $numorden) {
        $this->testamento = $testamento;
        $this->otorgante = $otorgante;
        $this->num_orden = $numorden;
    }

    // Getters y setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestamento(): ?TestaTtestamento
    {
        return $this->testamento;
    }

    public function setTestamento(TestaTtestamento $testamento): self
    {
        $this->testamento = $testamento;
        return $this;
    }

    public function getOtorgante(): ?TestaTotorgante
    {
        return $this->otorgante;
    }

    public function setOtorgante(TestaTotorgante $otorgante): self
    {
        $this->otorgante = $otorgante;
        return $this;
    }

    public function getNumOrden(): int
    {
        return $this->num_orden;
    }

    public function setNumOrden(int $num_orden): self
    {
        $this->num_orden = $num_orden;
        return $this;
    }

 
}
