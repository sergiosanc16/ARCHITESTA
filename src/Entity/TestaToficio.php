<?php

namespace App\Entity;

use App\Repository\TestaToficioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaToficioRepository::class)]
class TestaToficio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $des_oficio = null;
    
    /** @var Collection<int, TestaTotorgante> */
    #[ORM\OneToMany(mappedBy: 'id_oficio', targetEntity: TestaTotorgante::class)]
    private Collection $id_otorgante;

    public function __construct()
    {
        $this->otorgantes = new ArrayCollection();
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

    public function getDesOficio(): ?string
    {
        return $this->des_oficio;
    }

    public function setDesOficio(string $des_oficio): static
    {
        $this->des_oficio = $des_oficio;

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
}
