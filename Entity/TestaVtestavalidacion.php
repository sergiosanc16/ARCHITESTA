<?php

namespace App\Entity;

use App\Repository\TestaVtestavalidacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaVtestavalidacionRepository::class)]
#[ORM\Table(name: 'testa_vtestavalidacion')]
class TestaVtestavalidacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $numValidacion = null;

    #[ORM\Column(type: Types::ARRAY)]
    private ?array $validaciones = [];

    #[ORM\Column]
    private int $idTestamento;

    #[ORM\Column]
    private int $idOtorgante;

    #[ORM\Column(type: 'smallint', options: ['unsigned' => true])]
    private int $numOrden;

    #[ORM\Column(type: 'smallint')]
    private int $anno;

    #[ORM\Column(type: 'string')]
    private string $mes;

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

    #[ORM\Column(type: 'string')]
    private ?string $estadoValidacion=null;

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

    #[ORM\ManyToOne(targetEntity: TestaTotorgante::class)]
    #[ORM\JoinColumn(name: 'id_otorgante', referencedColumnName: 'id', nullable: true)]
    private ?TestaTotorgante $otorgante = null;


    function __construct(int $anno, string $mes, int $dia, bool $mancomunado, bool $textoilegible,
                         int $num_protocolo, int $num_folio, TestaTpoblacion $poblacion,
                         TestaTnotario $notario, TestaTimagen $imagen, TestaTparentesco $parentesco, string $estado_validacion) {
        $this->anno = $anno;
        $this->mes = $mes;
        $this->dia = $dia;
        $this->mancomunado = $mancomunado;
        $this->textoilegible = $textoilegible;
        $this->num_protocolo = $num_protocolo;
        $this->num_folio = $num_folio;
        $this->poblacion = $poblacion;
        $this->notario = $notario;
        $this->imagen = $imagen;
        $this->parentesco = $parentesco;
        $this->estadoValidacion = $estado_validacion;
    }


    #[ORM\Column(length: 100)]
    private string $nombre;

    #[ORM\Column(length: 100)]
    private string $apellido1;

    #[ORM\Column(length: 100)]
    private string $apellido2;

    #[ORM\Column]
    private int $idOficio;

    #[ORM\Column(length: 100)]
    private string $desPoblacion;

    #[ORM\Column(length: 200)]
    private string $desNotario;

    #[ORM\Column(length: 100)]
    private string $desImagen;

    #[ORM\Column(length: 100)]
    private string $desParentesco;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getnumValidacion(): ?int 
    {
        return $this->numValidacion; 
    }

    public function getAnno(): int 
    {
        return $this->anno; 
    }
    public function setAnno(int $anno): self 
    { 
        $this->anno = $anno; 
        return $this; 
    }

    public function getMes(): string 
    { 
        return $this->mes; 
    }
    public function setMes(string $mes): self 
    { 
        $this->mes = $mes;
        return $this; 
    }

    public function getDia(): int 
    { 
        return $this->dia; 
    }
    public function setDia(int $dia): self 
    { 
        $this->dia = $dia; 
        return $this; 
    }

    public function isMancomunado(): bool 
    { 
        return $this->mancomunado; 
    }
    public function setMancomunado(bool $mancomunado): self 
    { 
        $this->mancomunado = $mancomunado; 
        return $this; 
    }

    public function isTextoilegible(): bool 
    { 
        return $this->textoilegible; 
    }
    public function setTextoilegible(bool $textoilegible): self 
    { 
        $this->textoilegible = $textoilegible; 
        return $this; 
    }

    public function getNumProtocolo(): int 
    { 
        return $this->num_protocolo; 
    }
    public function setNumProtocolo(int $num_protocolo): self 
    { 
        $this->num_protocolo = $num_protocolo; 
        return $this; 
    }

    public function getNumFolio(): int 
    { 
        return $this->num_folio; 
    }
    public function setNumFolio(int $num_folio): self 
    { 
        $this->num_folio = $num_folio; 
        return $this; 
    }

    public function getIdTestamento(): int 
    { 
        return $this->idTestamento; 
    }
    public function setIdTestamento(int $idTestamento): self 
    { 
        $this->idTestamento = $idTestamento; 
        return $this; 
    }

    public function getNombre(): ? string 
    { 
        return $this->nombre; 
    }
    public function setNombre(string $nombre): self 
    { 
        $this->nombre = $nombre; 
        return $this; 
    }

    public function getApellido1(): ? string 
    { 
        return $this->apellido1; 
    }
    public function setApellido1(string $apellido1): self 
    { 
        $this->apellido1 = $apellido1; 
        return $this; 
    }

    public function getApellido2(): ? string 
    { 
        return $this->apellido2; 
    }
    public function setApellido2(string $apellido2): self 
    { 
        $this->apellido2 = $apellido2; 
        return $this; 
    }

    public function getPoblacion(): ?TestaTpoblacion 
    { 
        return $this->poblacion; 
    }
    public function setPoblacion(?TestaTpoblacion $poblacion): self 
    { 
        $this->poblacion = $poblacion; 
        return $this; 
    }

    public function getNotario(): ?TestaTnotario 
    { 
        return $this->notario; 
    }
    public function setNotario(?TestaTnotario $notario): self 
    { 
        $this->notario = $notario;
        return $this; 
    }

    public function getImagen(): ?TestaTimagen 
    { 
        return $this->imagen; 
    }
    public function setImagen(?TestaTimagen $imagen): self 
    { 
        $this->imagen = $imagen;
        return $this; 
    }

    public function getParentesco(): ?TestaTparentesco 
    { 
        return $this->parentesco;
    }
    public function setParentesco(?TestaTparentesco $parentesco): self 
    { 
        $this->parentesco = $parentesco;
        return $this;
    }
    public function getOtorgante(): ?TestaTotorgante 
    { 
        return $this->otorgante;
    }
    public function setOtrogante(?TestaTotorgante $otorgante): self 
    { 
        $this->otorgante = $otorgante;
        return $this;
    }


    public function getValidaciones(): ?array
    {
        return $this->validaciones;
    }

    public function setValidaciones(?array $validaciones): static
    {
        $this->validaciones = $validaciones;

        return $this;
    }

    public function getEstadoValidacion(): ?string 
    { 
        return $this->estadoValidacion ; 
    }
    public function setEstadoValidacion(string $estadoValidacion ): self 
    { 
        $this->estadoValidacion = $estadoValidacion ;
        return $this; 
    }

    public function __toString(){ 

        // to show the name of the Category in the select 

        return $this->id.'-'.$this->dia.'/'.$this->mes.'/'.$this->anno; 
    }  
}
