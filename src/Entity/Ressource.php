<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourceRepository::class)]
class Ressource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ressources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mention $mention = null;

    #[ORM\Column(length: 150)]
    private ?string $libelle = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $typologie = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 1, nullable: true)]
    private ?string $ci = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 1, nullable: true)]
    private ?string $cm = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 1, nullable: true)]
    private ?string $td = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 1, nullable: true)]
    private ?string $tp = null;

    #[ORM\Column(nullable: true)]
    private ?int $projetAutonomie = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctExpression = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctInternationale = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctNumeriquePix = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctTeds = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctMtu = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctProfessionnelle = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctInformationnelle = null;

    #[ORM\Column(nullable: true)]
    private ?bool $vssh = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctNumerique = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctRecherche = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ctCollaboratif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getMention(): ?Mention
    {
        return $this->mention;
    }

    public function setMention(?Mention $mention): static
    {
        $this->mention = $mention;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTypologie(): ?string
    {
        return $this->typologie;
    }

    public function setTypologie(?string $typologie): static
    {
        $this->typologie = $typologie;

        return $this;
    }

    public function getCi(): ?string
    {
        return $this->ci;
    }

    public function setCi(?string $ci): static
    {
        $this->ci = $ci;

        return $this;
    }

    public function getCm(): ?string
    {
        return $this->cm;
    }

    public function setCm(?string $cm): static
    {
        $this->cm = $cm;

        return $this;
    }

    public function getTd(): ?string
    {
        return $this->td;
    }

    public function setTd(?string $td): static
    {
        $this->td = $td;

        return $this;
    }

    public function getTp(): ?string
    {
        return $this->tp;
    }

    public function setTp(?string $tp): static
    {
        $this->tp = $tp;

        return $this;
    }

    public function getProjetAutonomie(): ?int
    {
        return $this->projetAutonomie;
    }

    public function setProjetAutonomie(?int $projetAutonomie): static
    {
        $this->projetAutonomie = $projetAutonomie;

        return $this;
    }

    public function isCtExpression(): ?bool
    {
        return $this->ctExpression;
    }

    public function setCtExpression(?bool $ctExpression): static
    {
        $this->ctExpression = $ctExpression;

        return $this;
    }

    public function isCtInternationale(): ?bool
    {
        return $this->ctInternationale;
    }

    public function setCtInternationale(?bool $ctInternationale): static
    {
        $this->ctInternationale = $ctInternationale;

        return $this;
    }

    public function isCtNumeriquePix(): ?bool
    {
        return $this->ctNumeriquePix;
    }

    public function setCtNumeriquePix(?bool $ctNumeriquePix): static
    {
        $this->ctNumeriquePix = $ctNumeriquePix;

        return $this;
    }

    public function isCtTeds(): ?bool
    {
        return $this->ctTeds;
    }

    public function setCtTeds(?bool $ctTeds): static
    {
        $this->ctTeds = $ctTeds;

        return $this;
    }

    public function isCtMtu(): ?bool
    {
        return $this->ctMtu;
    }

    public function setCtMtu(?bool $ctMtu): static
    {
        $this->ctMtu = $ctMtu;

        return $this;
    }

    public function isCtProfessionnelle(): ?bool
    {
        return $this->ctProfessionnelle;
    }

    public function setCtProfessionnelle(?bool $ctProfessionnelle): static
    {
        $this->ctProfessionnelle = $ctProfessionnelle;

        return $this;
    }

    public function isCtInformationnelle(): ?bool
    {
        return $this->ctInformationnelle;
    }

    public function setCtInformationnelle(?bool $ctInformationnelle): static
    {
        $this->ctInformationnelle = $ctInformationnelle;

        return $this;
    }

    public function isVssh(): ?bool
    {
        return $this->vssh;
    }

    public function setVssh(?bool $vssh): static
    {
        $this->vssh = $vssh;

        return $this;
    }

    public function isCtNumerique(): ?bool
    {
        return $this->ctNumerique;
    }

    public function setCtNumerique(?bool $ctNumerique): static
    {
        $this->ctNumerique = $ctNumerique;

        return $this;
    }

    public function isCtRecherche(): ?bool
    {
        return $this->ctRecherche;
    }

    public function setCtRecherche(?bool $ctRecherche): static
    {
        $this->ctRecherche = $ctRecherche;

        return $this;
    }

    public function isCtCollaboratif(): ?bool
    {
        return $this->ctCollaboratif;
    }

    public function setCtCollaboratif(?bool $ctCollaboratif): static
    {
        $this->ctCollaboratif = $ctCollaboratif;

        return $this;
    }
}
