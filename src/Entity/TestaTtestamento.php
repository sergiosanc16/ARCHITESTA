<?php

namespace App\Entity;

use App\Repository\TestaTtestamentoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaTtestamentoRepository::class)]
#[ORM\Table(name: 'testa_ttestamento')]
class TestaTtestamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'smallint')]
    private int $anno;

    #[ORM\Column(type: 'smallint')]
    private int $mes;

    #[ORM\Column(type: 'smallint')]
    private int $dia;

    #[ORM\Column(type: 'boolean')]
    private bool $mancomunado;

    #[ORM\Column(type: 'boolean')]
    private bool $textoilegible;

    #[ORM\Column(type: 'integer')]
    private int $num_protocolo;

    #[ORM\Column(type: 'integer')]
    private int $num_folio;

    #[ORM\ManyToOne(targetEntity: TestaTpoblacion::class)]
    #[ORM\JoinColumn(name: 'id_poblacion', referencedColumnName: 'id', nullable: true)]
    private ?TestaTpoblacion $poblacion = null;

    #[ORM\ManyToOne(targetEntity: TestaTnotario::class)]
    #[ORM\JoinColumn(name: 'id_notario', referencedColumnName: 'id', nullable: true)]
    private ?TestaTnotario $notario = null;

    #[ORM\OneToOne(targetEntity: TestaTimagen::class)]
    #[ORM\JoinColumn(name: 'id_imagen', referencedColumnName: 'id', unique: true, nullable: true)]
    private ?TestaTimagen $imagen = null;

    #[ORM\ManyToOne(targetEntity: TestaTparentesco::class)]
    #[ORM\JoinColumn(name: 'id_parentesco', referencedColumnName: 'id', nullable: true)]
    private ?TestaTparentesco $parentesco = null;

    // Getters y setters...

    public function getId(): ?int { return $this->id; }

    public function getAnno(): int { return $this->anno; }
    public function setAnno(int $anno): self { $this->anno = $anno; return $this; }

    public function getMes(): int { return $this->mes; }
    public function setMes(int $mes): self { $this->mes = $mes; return $this; }

    public function getDia(): int { return $this->dia; }
    public function setDia(int $dia): self { $this->dia = $dia; return $this; }

    public function isMancomunado(): bool { return $this->mancomunado; }
    public function setMancomunado(bool $mancomunado): self { $this->mancomunado = $mancomunado; return $this; }

    public function isTextoilegible(): bool { return $this->textoilegible; }
    public function setTextoilegible(bool $textoilegible): self { $this->textoilegible = $textoilegible; return $this; }

    public function getNumProtocolo(): int { return $this->num_protocolo; }
    public function setNumProtocolo(int $num_protocolo): self { $this->num_protocolo = $num_protocolo; return $this; }

    public function getNumFolio(): int { return $this->num_folio; }
    public function setNumFolio(int $num_folio): self { $this->num_folio = $num_folio; return $this; }

    public function getPoblacion(): ?TestaTpoblacion { return $this->poblacion; }
    public function setPoblacion(?TestaTpoblacion $poblacion): self { $this->poblacion = $poblacion; return $this; }

    public function getNotario(): ?TestaTnotario { return $this->notario; }
    public function setNotario(?TestaTnotario $notario): self { $this->notario = $notario; return $this; }

    public function getIdParentesco(): ?TestaTparentesco
    {
        return $this->id_parentesco;
    }

    public function setIdParentesco(TestaTparentesco $idParentesco): static
    {        
        $this->id_parentesco = $idParentesco;

        return $this;
    }

    public function getParentesco(): ?TestaTparentesco { return $this->parentesco; }
    public function setParentesco(?TestaTparentesco $parentesco): self { $this->parentesco = $parentesco; return $this; }

    public function __toString(){ 

        // to show the name of the Category in the select 

        return $this;
    }

    public function __toString(){ 
        // to show the name of the Category in the select 
        return $this->id.'-'.$this->dia.'/'.$this->mes.'/'.$this->anno; 
    } 
}
