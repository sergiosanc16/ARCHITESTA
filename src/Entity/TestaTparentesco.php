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

    #[ORM\OneToOne(targetEntity: TestaTtestamento::class, mappedBy: 'id_parentesco',cascade: ['persist', 'remove'])]
    private ?TestaTtestamento $testaTtestamentos;

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

    public function getTestaTtestamentos(): ?TestaTtestamento
    {
        return $this->testaTtestamentos;
    }

    public function setTestaTtestamento(TestaTtestamento $testaTtestamento): static
    {
        $this->testaTtestamentos = $testaTtestamento;

        return $this;
    }
}
