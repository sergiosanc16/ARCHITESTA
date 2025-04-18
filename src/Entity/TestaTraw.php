<?php
namespace App\Entity;

use App\Repository\TestaTrawRepository;
use Symfony\Component\Form\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\SyntaxError;

#[ORM\Entity(repositoryClass: TestaTrawRepository::class)]
class TestaTraw
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $classificationId = null;

    #[ORM\Column]
    private ?int $year = 0;

    #[ORM\Column(length: 10)]
    private ?string $month = 'Ninguno';

    #[ORM\Column]
    private ?int $day = 0;

    #[ORM\Column]
    private ?bool $otherPopulation = FALSE;

    #[ORM\Column(length: 255)]
    private ?string $populationName = 'Ninguna';

    #[ORM\Column(length: 255)]
    private ?string $grantorSurname1 = 'Ninguno';

    #[ORM\Column(length: 255)]
    private ?string $gratorSurname2 = 'Ninguno';

    #[ORM\Column(length: 255)]
    private ?string $grantorName = 'Ninguno';

    #[ORM\Column]
    private ?bool $officeMentioned = FALSE;

    #[ORM\Column(length: 255)]
    private ?string $grantorOffice = 'Ninguno';

    #[ORM\Column]
    private ?bool $relationshipMentioned = FALSE;

    #[ORM\Column(length: 255)]
    private ?string $grantorRelationship = 'Ninguna';

    #[ORM\Column(length: 255)]
    private ?string $documentType = 'Ninguno';

    #[ORM\Column(length: 255)]
    private ?string $notaryName = 'Ningun@';

    #[ORM\Column]
    private ?int $protocolNumber = 0;

    #[ORM\Column]
    private ?int $folioNumber = 0;

    #[ORM\Column]
    private ?bool $secondGrantor = FALSE;

    #[ORM\Column(length: 255)]
    private ?string $secondGrantorName = 'Ninguno';

    #[ORM\Column(length: 255)]
    private ?string $filename = 'Ninguno';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassificationId(): ?string
    {
        return $this->classificationId;
    }

    public function setClassificationId(string $classificationId): static
    {
        $this->classificationId = $classificationId;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(string $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function isOtherPopulation(): ?bool
    {
        return $this->otherPopulation;
    }

    public function setOtherPopulation(bool $otherPopulation): static
    {
        $this->otherPopulation = $otherPopulation;

        return $this;
    }

    public function getPopulationName(): ?string
    {
        return $this->populationName;
    }

    public function setPopulationName(string $populationName): static
    {
        $this->populationName = $populationName;

        return $this;
    }

    public function getGrantorSurname1(): ?string
    {
        return $this->grantorSurname1;
    }

    public function setGrantorSurname1(string $grantorSurname1): static
    {
        $this->grantorSurname1 = $grantorSurname1;

        return $this;
    }

    public function getGratorSurname2(): ?string
    {
        return $this->gratorSurname2;
    }

    public function setGratorSurname2(string $gratorSurname2): static
    {
        $this->gratorSurname2 = $gratorSurname2;

        return $this;
    }

    public function getGrantorName(): ?string
    {
        return $this->grantorName;
    }

    public function setGrantorName(string $grantorName): static
    {
        $this->grantorName = $grantorName;

        return $this;
    }

    public function isOfficeMentioned(): ?bool
    {
        return $this->officeMentioned;
    }

    public function setOfficeMentioned(bool $officeMentioned): static
    {
        $this->officeMentioned = $officeMentioned;

        return $this;
    }

    public function getGrantorOffice(): ?string
    {
        return $this->grantorOffice;
    }

    public function setGrantorOffice(string $grantorOffice): static
    {
        $this->grantorOffice = $grantorOffice;

        return $this;
    }

    public function isRelationshipMentioned(): ?bool
    {
        return $this->relationshipMentioned;
    }

    public function setRelationshipMentioned(bool $relationshipMentioned): static
    {
        $this->relationshipMentioned = $relationshipMentioned;

        return $this;
    }

    public function getGrantorRelationship(): ?string
    {
        return $this->grantorRelationship;
    }

    public function setGrantorRelationship(string $grantorRelationship): static
    {
        $this->grantorRelationship = $grantorRelationship;

        return $this;
    }

    public function getDocumentType(): ?string
    {
        return $this->documentType;
    }

    public function setDocumentType(string $documentType): static
    {
        $this->documentType = $documentType;

        return $this;
    }

    public function getNotaryName(): ?string
    {
        return $this->notaryName;
    }

    public function setNotaryName(string $notaryName): static
    {
        $this->notaryName = $notaryName;

        return $this;
    }

    public function getProtocolNumber(): ?int
    {
        return $this->protocolNumber;
    }

    public function setProtocolNumber(int $protocolNumber): static
    {
        $this->protocolNumber = $protocolNumber;

        return $this;
    }

    public function getFolioNumber(): ?int
    {
        return $this->folioNumber;
    }

    public function setFolioNumber(int $folioNumber): static
    {
        $this->folioNumber = $folioNumber;

        return $this;
    }

    public function isSecondGrantor(): ?bool
    {
        return $this->secondGrantor;
    }

    public function setSecondGrantor(bool $secondGrantor): static
    {
        $this->secondGrantor = $secondGrantor;

        return $this;
    }

    public function getSecondGrantorName(): ?string
    {
        return $this->secondGrantorName;
    }

    public function setSecondGrantorName(string $secondGrantorName): static
    {
        $this->secondGrantorName = $secondGrantorName;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

}
