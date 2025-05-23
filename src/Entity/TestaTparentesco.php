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

    /**
     * @var Collection<int, TestaTtestamento>
     */
    #[ORM\ManyToMany(targetEntity: TestaTtestamento::class, mappedBy: 'id_parentesco')]
    private Collection $testaTtestamentos;

    public function __construct(string $desParentesco)
    {
        $this->testaTtestamentos = new ArrayCollection();
        $this->des_parentesco = $desParentesco;
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

    public function getDesParentesco(): ?string
    {
        return $this->des_parentesco;
    }

    public function setDesParentesco(string $des_parentesco): static
    {
        $this->des_parentesco = $des_parentesco;

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
            $testaTtestamento->addIdParentesco($this);
        }

        return $this;
    }

    public function removeTestaTtestamento(TestaTtestamento $testaTtestamento): static
    {
        if ($this->testaTtestamentos->removeElement($testaTtestamento)) {
            $testaTtestamento->removeIdParentesco($this);
        }

        return $this;
    }
    public function __toString(){ 

        // to show the name of the Category in the select 

        return $this->des_parentesco; 

        // to show the id of the Category in the select 

        // return $this->id; 

}         
}
