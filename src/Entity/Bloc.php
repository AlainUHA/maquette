<?php

namespace App\Entity;

use App\Repository\BlocRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocRepository::class)]
class Bloc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'blocs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mention $mention = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, ApprentissageCritique>
     */
    #[ORM\OneToMany(targetEntity: ApprentissageCritique::class, mappedBy: 'bloc')]
    private Collection $apprentissageCritiques;

    /**
     * @var Collection<int, Niveau>
     */
    #[ORM\OneToMany(targetEntity: Niveau::class, mappedBy: 'bloc')]
    private Collection $niveaux;

    public function __construct()
    {
        $this->apprentissageCritiques = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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
            $apprentissageCritique->setBloc($this);
        }

        return $this;
    }

    public function removeApprentissageCritique(ApprentissageCritique $apprentissageCritique): static
    {
        if ($this->apprentissageCritiques->removeElement($apprentissageCritique)) {
            // set the owning side to null (unless already changed)
            if ($apprentissageCritique->getBloc() === $this) {
                $apprentissageCritique->setBloc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Niveau>
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): static
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux->add($niveau);
            $niveau->setBloc($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): static
    {
        if ($this->niveaux->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getBloc() === $this) {
                $niveau->setBloc(null);
            }
        }

        return $this;
    }
}
