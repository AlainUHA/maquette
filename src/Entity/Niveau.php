<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Range(min: 1, max: 6)]
    private ?int $niveau = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'niveaux')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competence $competence = null;

    /**
     * @var Collection<int, ApprentissageCritique>
     */
    #[ORM\OneToMany(targetEntity: ApprentissageCritique::class, mappedBy: 'niveau')]
    private Collection $apprentissagesCritiques;

    /**
     * @var Collection<int, Parcours>
     */
    #[ORM\ManyToMany(targetEntity: Parcours::class, inversedBy: 'niveaux')]
    private Collection $parcours;

    /**
     * @var Collection<int, UE>
     */
    #[ORM\OneToMany(targetEntity: UE::class, mappedBy: 'niveau')]
    private Collection $UEs;

    public function __construct()
    {
        $this->apprentissagesCritiques = new ArrayCollection();
        $this->parcours = new ArrayCollection();
        $this->UEs = new ArrayCollection();
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

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): static
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * @return Collection<int, ApprentissageCritique>
     */
    public function getApprentissagesCritiques(): Collection
    {
        return $this->apprentissagesCritiques;
    }

    public function addApprentissagesCritique(ApprentissageCritique $ac): static
    {
        if (!$this->apprentissagesCritiques->contains($ac)) {
            $this->apprentissagesCritiques->add($ac);
            $ac->setNiveau($this);
        }

        return $this;
    }

    public function removeApprentissagesCritique(ApprentissageCritique $apprentissagesCritique): static
    {
        if ($this->apprentissagesCritiques->removeElement($apprentissagesCritique)) {
            // set the owning side to null (unless already changed)
            if ($apprentissagesCritique->getNiveau() === $this) {
                $apprentissagesCritique->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Parcours>
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcours(Parcours $p): static
    {
        if (!$this->parcours->contains($p)) {
            $this->parcours->add($p);
        }
        return $this;
    }

    public function removeParcours(Parcours $p): static
    {
        $this->parcours->removeElement($p);
        return $this;
    }

    /**
     * @return Collection<int, UE>
     */
    public function getUEs(): Collection
    {
        return $this->UEs;
    }

    public function addUE(UE $uE): static
    {
        if (!$this->UEs->contains($uE)) {
            $this->UEs->add($uE);
            $uE->setNiveau($this);
        }

        return $this;
    }

    public function removeUE(UE $uE): static
    {
        if ($this->UEs->removeElement($uE)) {
            // set the owning side to null (unless already changed)
            if ($uE->getNiveau() === $this) {
                $uE->setNiveau(null);
            }
        }

        return $this;
    }
}
