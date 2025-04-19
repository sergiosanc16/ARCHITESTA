<?php

namespace App\Entity;

use App\Repository\TestaTtestamentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTtestamentoRepository::class)]
class TestaTtestamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $anno = null;

    #[ORM\Column]
    private ?string $mes = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $dia = null;

    #[ORM\Column]
    private ?bool $mancomunado = null;

    #[ORM\Column]
    private ?bool $textoilegible = null;

    #[ORM\Column]
    private ?int $num_protocolo = null;

    #[ORM\Column]
    private ?int $num_folio = null;

    #[ORM\ManyToOne(inversedBy: 'testaTpoblacion')]
    #[ORM\JoinColumn(name: "id_poblacion", referencedColumnName: "id")]
    private ?TestaTpoblacion $id_poblacion = null;

    #[ORM\ManyToOne(inversedBy: 'testaTtestamentos')]
    #[ORM\JoinColumn(name: "id_notario", referencedColumnName: "id")]
    private ?TestaTnotario $id_notario = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], targetEntity:'TestaTparentesco')]
    #[ORM\JoinColumn(name: "id_parentesco", referencedColumnName: "id")]
    private ?TestaTparentesco $id_parentesco = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "id_imagen", referencedColumnName: "id")]
    private ?TestaTimagen $id_imagen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPoblacion(): ?TestaTpoblacion
    {
        return $this->id_poblacion;
    }

    public function setIdPoblacion(?TestaTpoblacion $poblacion): self
    {
        $this->id_poblacion = $poblacion;
        return $this;
    }

    public function getAnno(): ?int
    {
        return $this->anno;
    }

    public function setAnno(int $anno): static
    {
        $this->anno = $anno;

        return $this;
    }

    public function getMes(): ?string
    {
        return $this->mes;
    }

    public function setMes(string $mes): static
    {
        $this->mes = $mes;

        return $this;
    }

    public function getDia(): ?int
    {
        return $this->dia;
    }

    public function setDia(int $dia): static
    {
        $this->dia = $dia;

        return $this;
    }

    public function isMancomunado(): ?bool
    {
        return $this->mancomunado;
    }

    public function setMancomunado(bool $mancomunado): static
    {
        $this->mancomunado = $mancomunado;

        return $this;
    }

    public function isTextoilegible(): ?bool
    {
        return $this->textoilegible;
    }

    public function setTextoilegible(bool $textoilegible): static
    {
        $this->textoilegible = $textoilegible;

        return $this;
    }

    public function getNumProtocolo(): ?int
    {
        return $this->num_protocolo;
    }

    public function setNumProtocolo(int $num_protocolo): static
    {
        $this->num_protocolo = $num_protocolo;

        return $this;
    }

    public function getNumFolio(): ?int
    {
        return $this->num_folio;
    }

    public function setNumFolio(?int $num_folio): static
    {
        $this->num_folio = $num_folio;

        return $this;
    }

    public function getIdNotario(): ?TestaTnotario
    {
        return $this->id_notario;
    }

    public function setIdNotario(?TestaTnotario $id_notario): static
    {
        $this->id_notario = $id_notario;

        return $this;
    }

    public function getIdParentesco(): ?TestaTparentesco
    {
        return $this->id_parentesco;
    }

    public function setIdParentesco(TestaTparentesco $idParentesco): static
    {        
        $this->id_parentesco = $idParentesco;

        return $this;
    }


    public function getIdImagen(): ?TestaTimagen
    {
        return $this->id_imagen;
    }

    public function setIdImagen(?TestaTimagen $id_imagen): static
    {
        $this->id_imagen = $id_imagen;

        return $this;
    }
}
