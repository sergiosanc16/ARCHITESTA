<?php

namespace App\Entity;

use App\Repository\TestaTpoblacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTpoblacionRepository::class)]
class TestaTpoblacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $des_poblacion = null;

    /**
     * @var Collection<int, TestaTtestamento>
     */
    #[ORM\OneToMany(targetEntity: TestaTtestamento::class, mappedBy: 'id_poblacion')]
    private Collection $testaTtestamentos;

    /**
     * @var Collection<int, TestaTtestamento>
     */
    #[ORM\OneToMany(targetEntity: TestaTtestamento::class, mappedBy: 'num_folio')]
    private Collection $borrar;

    public function __construct()
    {
        $this->testaTtestamentos = new ArrayCollection();
        $this->borrar = new ArrayCollection();
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

    public function getDesPoblacion(): ?string
    {
        return $this->des_poblacion;
    }

    public function setDesPoblacion(string $des_poblacion): static
    {
        $this->des_poblacion = $des_poblacion;

        return $this;
    }

    /**
     * @return Collection<int, TestaTtestamento>
     */
    public function getTestaTtestamentos(): Collection
    {
        return $this->testaTtestamentos;
    }

    public function addTestaTtestamento(TestaTtestamento $testaTtestamento): static
    {
        if (!$this->testaTtestamentos->contains($testaTtestamento)) {
            $this->testaTtestamentos->add($testaTtestamento);
            $testaTtestamento->setIdPoblacion($this);
        }

        return $this;
    }

    public function removeTestaTtestamento(TestaTtestamento $testaTtestamento): static
    {
        if ($this->testaTtestamentos->removeElement($testaTtestamento)) {
            // set the owning side to null (unless already changed)
            if ($testaTtestamento->getIdPoblacion() === $this) {
                $testaTtestamento->setIdPoblacion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TestaTtestamento>
     */
    public function getBorrar(): Collection
    {
        return $this->borrar;
    }

    public function addBorrar(TestaTtestamento $borrar): static
    {
        if (!$this->borrar->contains($borrar)) {
            $this->borrar->add($borrar);
            $borrar->setNumFolio($this);
        }

        return $this;
    }

    public function removeBorrar(TestaTtestamento $borrar): static
    {
        if ($this->borrar->removeElement($borrar)) {
            // set the owning side to null (unless already changed)
            if ($borrar->getNumFolio() === $this) {
                $borrar->setNumFolio(null);
            }
        }

        return $this;
    }
}
