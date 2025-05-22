<?php

namespace App\Entity;

use App\Repository\TestaVtestaotorganteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestaVtestaotorganteRepository::class)]
#[ORM\Table(name: 'testa_vtestaotorgante')]
class TestaVtestaotorgante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'id_testamento', type: 'integer')]
    private int $idTestamento;

    #[ORM\Column(name: 'id_otorgante', type: 'integer')]
    private int $idOtorgante;

    #[ORM\Column(name: 'num_orden', type: 'smallint', options: ['unsigned' => true, 'default' => 1])]
    private int $numOrden = 1;

    #[ORM\Column(name: 'anno', type: 'smallint')]
    private int $anno;

    #[ORM\Column(name: 'mes', type: 'smallint')]
    private int $mes;

    #[ORM\Column(name: 'dia', type: 'smallint')]
    private int $dia;

    #[ORM\Column(name: 'mancomunado', type: 'boolean')]
    private bool $mancomunado;

    #[ORM\Column(name: 'textoilegible', type: 'boolean')]
    private bool $textoIlegible;

    #[ORM\Column(name: 'num_protocolo', type: 'integer')]
    private int $numProtocolo;

    #[ORM\Column(name: 'num_folio', type: 'integer')]
    private int $numFolio;

    #[ORM\Column(name: 'id_poblacion', type: 'integer', nullable: true)]
    private ?int $idPoblacion = null;

    #[ORM\Column(name: 'id_notario', type: 'integer', nullable: true)]
    private ?int $idNotario = null;

    #[ORM\Column(name: 'id_imagen', type: 'integer', nullable: true)]
    private ?int $idImagen = null;

    #[ORM\Column(name: 'id_parentesco', type: 'integer', nullable: true)]
    private ?int $idParentesco = null;

    #[ORM\Column(name: 'nombre', type: 'string', length: 100)]
    private string $nombre;

    #[ORM\Column(name: 'apellido1', type: 'string', length: 100)]
    private string $apellido1;

    #[ORM\Column(name: 'apellido2', type: 'string', length: 100)]
    private string $apellido2;

    #[ORM\Column(name: 'id_oficio', type: 'integer')]
    private int $idOficio;

    #[ORM\Column(name: 'des_poblacion', type: 'string', length: 100)]
    private string $desPoblacion;

    #[ORM\Column(name: 'DES_NOTARIO', type: 'string', length: 200)]
    private string $desNotario;

    #[ORM\Column(name: 'des_imagen', type: 'string', length: 100)]
    private string $desImagen;

    #[ORM\Column(name: 'des_parentesco', type: 'string', length: 100)]
    private string $desParentesco;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdOtorgante(): int
    {
        return $this->idOtorgante;
    }

    public function setIdOtorgante(int $idOtorgante): self
    {
        $this->idOtorgante = $idOtorgante;
        return $this;
    }

    public function getNumOrden(): int
    {
        return $this->numOrden;
    }

    public function setNumOrden(int $numOrden): self
    {
        $this->numOrden = $numOrden;
        return $this;
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

    public function getMes(): int
    {
        return $this->mes;
    }

    public function setMes(int $mes): self
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

    public function isTextoIlegible(): bool
    {
        return $this->textoIlegible;
    }

    public function setTextoIlegible(bool $textoIlegible): self
    {
        $this->textoIlegible = $textoIlegible;
        return $this;
    }

    public function getNumProtocolo(): int
    {
        return $this->numProtocolo;
    }

    public function setNumProtocolo(int $numProtocolo): self
    {
        $this->numProtocolo = $numProtocolo;
        return $this;
    }

    public function getNumFolio(): int
    {
        return $this->numFolio;
    }

    public function setNumFolio(int $numFolio): self
    {
        $this->numFolio = $numFolio;
        return $this;
    }

    public function getIdPoblacion(): ?int
    {
        return $this->idPoblacion;
    }

    public function setIdPoblacion(?int $idPoblacion): self
    {
        $this->idPoblacion = $idPoblacion;
        return $this;
    }

    public function getIdNotario(): ?int
    {
        return $this->idNotario;
    }

    public function setIdNotario(?int $idNotario): self
    {
        $this->idNotario = $idNotario;
        return $this;
    }

    public function getIdImagen(): ?int
    {
        return $this->idImagen;
    }

    public function setIdImagen(?int $idImagen): self
    {
        $this->idImagen = $idImagen;
        return $this;
    }

    public function getIdParentesco(): ?int
    {
        return $this->idParentesco;
    }

    public function setIdParentesco(?int $idParentesco): self
    {
        $this->idParentesco = $idParentesco;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellido1(): string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): self
    {
        $this->apellido1 = $apellido1;
        return $this;
    }

    public function getApellido2(): string
    {
        return $this->apellido2;
    }

    public function setApellido2(string $apellido2): self
    {
        $this->apellido2 = $apellido2;
        return $this;
    }

    public function getIdOficio(): int
    {
        return $this->idOficio;
    }

    public function setIdOficio(int $idOficio): self
    {
        $this->idOficio = $idOficio;
        return $this;
    }

    public function getDesPoblacion(): string
    {
        return $this->desPoblacion;
    }

    public function getPoblacion(): string
    {
        return $this->desPoblacion;
    }

    public function setDesPoblacion(string $desPoblacion): self
    {
        $this->desPoblacion = $desPoblacion;
        return $this;
    }

    public function getDesNotario(): string
    {
        return $this->desNotario;
    }

    public function getNotario(): string
    {
        return $this->desNotario;
    }


    public function setDesNotario(string $desNotario): self
    {
        $this->desNotario = $desNotario;
        return $this;
    }

    public function getDesImagen(): string
    {
        return $this->desImagen;
    }

    public function getImagen(): string
    {
        return $this->desImagen;
    }

    public function setDesImagen(string $desImagen): self
    {
        $this->desImagen = $desImagen;
        return $this;
    }

    public function getDesParentesco(): string
    {
        return $this->desParentesco;
    }

    public function setDesParentesco(string $desParentesco): self
    {
        $this->desParentesco = $desParentesco;
        return $this;
    }
}
