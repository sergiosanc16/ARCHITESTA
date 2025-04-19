<?php

namespace App\Entity;

use App\Repository\TestaTtestaotorganteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTtestaotorganteRepository::class)]
class TestaTtestaotorgante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "id_testamento", referencedColumnName: "id", nullable: false)]
    private ?TestaTtestamento $id_testamento = null;

    /**
     * @var Collection<int, TestaTotorgante>
     */
    #[ORM\OneToMany(targetEntity: TestaTotorgante::class)]
    #[ORM\JoinTable(
        name: 'testa_ttestaotorgante_otorgante',
        joinColumns:        [ new ORM\JoinColumn(name: 'ttestaotorgante_id', referencedColumnName: 'id', onDelete: 'CASCADE') ],
        inverseJoinColumns: [ new ORM\JoinColumn(name: 'otorgante_id',         referencedColumnName: 'id', onDelete: 'CASCADE') ]
    )]
    private Collection $id_otorgante;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $num_orden = null;

    public function __construct()
    {
        $this->id_otorgante = new ArrayCollection();
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

    public function setIdTestamento(?TestaTtestamento $id_testamento): static
    {
        $this->id_testamento = $id_testamento;

        return $this;
    }

    /**
     * @return Collection<int, TestaTotorgante>
     */
    public function getIdOtorgante(): Collection
    {
        return $this->id_otorgante;
    }

    public function addIdOtorgante(TestaTotorgante $idOtorgante): static
    {
        if (!$this->id_otorgante->contains($idOtorgante)) {
            $this->id_otorgante->add($idOtorgante);
        }

        return $this;
    }

    public function removeIdOtorgante(TestaTotorgante $idOtorgante): static
    {
        $this->id_otorgante->removeElement($idOtorgante);

        return $this;
    }

    public function getNumOrden(): ?int
    {
        return $this->num_orden;
    }

    public function setNumOrden(int $num_orden): static
    {
        $this->num_orden = $num_orden;

        return $this;
    }
}
