<?php

namespace App\Entity;

use App\Repository\TestaTnotarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTnotarioRepository::class)]
class TestaTnotario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $des_notario = null;

    /**
     * @var Collection<int, TestaTtestamento>
     */
    #[ORM\OneToMany(targetEntity: TestaTtestamento::class, mappedBy: 'id_notario')]
    private Collection $testaTtestamentos;

    public function __construct()
    {
        $this->testaTtestamentos = new ArrayCollection();
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

    public function getDesNotario(): ?string
    {
        return $this->des_notario;
    }

    public function setDesNotario(string $des_notario): static
    {
        $this->des_notario = $des_notario;

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
            $testaTtestamento->setIdNotario($this);
        }

        return $this;
    }

    public function removeTestaTtestamento(TestaTtestamento $testaTtestamento): static
    {
        if ($this->testaTtestamentos->removeElement($testaTtestamento)) {
            // set the owning side to null (unless already changed)
            if ($testaTtestamento->getIdNotario() === $this) {
                $testaTtestamento->setIdNotario(null);
            }
        }

        return $this;
    }
    public function __toString(){ 

        // to show the name of the Category in the select 

        return $this->des_notario; 
    } 

}
