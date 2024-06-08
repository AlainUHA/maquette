<?php

namespace App\Entity;

use App\Repository\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UERepository::class)]
class UE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'UEs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mention $mention = null;

    #[ORM\Column(length: 20)]
    private ?string $codeUE = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleUE = null;

    #[ORM\ManyToOne(inversedBy: 'UEs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveau $niveau = null;

    #[ORM\Column(nullable: true)]
    private ?int $coeff = null;

    #[ORM\Column(nullable: true)]
    private ?int $ects = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $m3c = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $m3cAssiduite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $m3cSession2 = null;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\ManyToMany(targetEntity: Ressource::class, inversedBy: 'UEs')]
    private Collection $ressources;

    /**
     * @var Collection<int, Parcours>
     */
    #[ORM\ManyToMany(targetEntity: Parcours::class, inversedBy: 'UEs')]
    private Collection $parcours;

    public function __construct()
    {
        $this->ressources = new ArrayCollection();
        $this->parcours = new ArrayCollection();
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

    public function getMention(): ?Mention
    {
        return $this->mention;
    }

    public function setMention(?Mention $mention): static
    {
        $this->mention = $mention;

        return $this;
    }

    public function getCodeUE(): ?string
    {
        return $this->codeUE;
    }

    public function setCodeUE(string $codeUE): static
    {
        $this->codeUE = $codeUE;

        return $this;
    }

    public function getLibelleUE(): ?string
    {
        return $this->libelleUE;
    }

    public function setLibelleUE(string $libelleUE): static
    {
        $this->libelleUE = $libelleUE;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getCoeff(): ?int
    {
        return $this->coeff;
    }

    public function setCoeff(?int $coeff): static
    {
        $this->coeff = $coeff;

        return $this;
    }

    public function getEcts(): ?int
    {
        return $this->ects;
    }

    public function setEcts(?int $ects): static
    {
        $this->ects = $ects;

        return $this;
    }

    public function getM3c(): ?string
    {
        return $this->m3c;
    }

    public function setM3c(?string $m3c): static
    {
        $this->m3c = $m3c;

        return $this;
    }

    public function getM3cAssiduite(): ?string
    {
        return $this->m3cAssiduite;
    }

    public function setM3cAssiduite(?string $m3cAssiduite): static
    {
        $this->m3cAssiduite = $m3cAssiduite;

        return $this;
    }

    public function getM3cSession2(): ?string
    {
        return $this->m3cSession2;
    }

    public function setM3cSession2(?string $m3cSession2): static
    {
        $this->m3cSession2 = $m3cSession2;

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        $this->ressources->removeElement($ressource);

        return $this;
    }

    /**
     * @return Collection<int, Parcours>
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcour(Parcours $parcour): static
    {
        if (!$this->parcours->contains($parcour)) {
            $this->parcours->add($parcour);
        }

        return $this;
    }

    public function removeParcour(Parcours $parcour): static
    {
        $this->parcours->removeElement($parcour);

        return $this;
    }
}
