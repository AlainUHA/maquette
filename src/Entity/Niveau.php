<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $niveau = null;

    #[ORM\Column(length: 50)]
    private ?string $description = null;

    /**
     * @var Collection<int, ApprentissageCritique>
     */
    #[ORM\OneToMany(targetEntity: ApprentissageCritique::class, mappedBy: 'niveau')]
    private Collection $apprentissageCritiques;

    #[ORM\ManyToOne(inversedBy: 'niveaux')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bloc $bloc = null;

    /**
     * @var Collection<int, Parcours>
     */
    #[ORM\ManyToMany(targetEntity: Parcours::class, inversedBy: 'niveaux')]
    private Collection $parcours;

    public function __construct()
    {
        $this->apprentissageCritiques = new ArrayCollection();
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

    /**
     * @return Collection<int, ApprentissageCritique>
     */
    public function getApprentissageCritiques(): Collection
    {
        return $this->apprentissageCritiques;
    }

    public function addApprentissageCritique(ApprentissageCritique $apprentissageCritique): static
    {
        if (!$this->apprentissageCritiques->contains($apprentissageCritique)) {
            $this->apprentissageCritiques->add($apprentissageCritique);
            $apprentissageCritique->setNiveau($this);
        }

        return $this;
    }

    public function removeApprentissageCritique(ApprentissageCritique $apprentissageCritique): static
    {
        if ($this->apprentissageCritiques->removeElement($apprentissageCritique)) {
            // set the owning side to null (unless already changed)
            if ($apprentissageCritique->getNiveau() === $this) {
                $apprentissageCritique->setNiveau(null);
            }
        }

        return $this;
    }

    public function getBloc(): ?Bloc
    {
        return $this->bloc;
    }

    public function setBloc(?Bloc $bloc): static
    {
        $this->bloc = $bloc;

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
