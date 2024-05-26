<?php

namespace App\Entity;

use App\Repository\MentionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MentionRepository::class)]
class Mention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'mentions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $resp = null;

    #[ORM\ManyToOne(inversedBy: 'mentions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Grade $grade = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modifiedAt = null;

    /**
     * @var Collection<int, AccesMention>
     */
    #[ORM\OneToMany(targetEntity: AccesMention::class, mappedBy: 'mention')]
    private Collection $accesMentions;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $rncp = null;

    /**
     * @var Collection<int, Parcours>
     */
    #[ORM\OneToMany(targetEntity: Parcours::class, mappedBy: 'mention')]
    private Collection $parcours;

    /**
     * @var Collection<int, Bloc>
     */
    #[ORM\OneToMany(targetEntity: Bloc::class, mappedBy: 'mention')]
    private Collection $blocs;

    #[ORM\ManyToOne(inversedBy: 'mentions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Composante $composante = null;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\OneToMany(targetEntity: Ressource::class, mappedBy: 'mention')]
    private Collection $ressources;

    public function __construct()
    {
        $this->accesMentions = new ArrayCollection();
        $this->parcours = new ArrayCollection();
        $this->blocs = new ArrayCollection();
        $this->ressources = new ArrayCollection();
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getResp(): ?Utilisateur
    {
        return $this->resp;
    }

    public function setResp(?Utilisateur $resp): static
    {
        $this->resp = $resp;

        return $this;
    }

    public function getGrade(): ?Grade
    {
        return $this->grade;
    }

    public function setGrade(?Grade $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeImmutable $modifiedAt): static
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * @return Collection<int, AccesMention>
     */
    public function getAccesMentions(): Collection
    {
        return $this->accesMentions;
    }

    public function addAccesMention(AccesMention $accesMention): static
    {
        if (!$this->accesMentions->contains($accesMention)) {
            $this->accesMentions->add($accesMention);
            $accesMention->setMention($this);
        }

        return $this;
    }

    public function removeAccesMention(AccesMention $accesMention): static
    {
        if ($this->accesMentions->removeElement($accesMention)) {
            // set the owning side to null (unless already changed)
            if ($accesMention->getMention() === $this) {
                $accesMention->setMention(null);
            }
        }

        return $this;
    }

    public function getRncp(): ?string
    {
        return $this->rncp;
    }

    public function setRncp(?string $rncp): static
    {
        $this->rncp = $rncp;

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
            $parcour->setMention($this);
        }

        return $this;
    }

    public function removeParcour(Parcours $parcour): static
    {
        if ($this->parcours->removeElement($parcour)) {
            // set the owning side to null (unless already changed)
            if ($parcour->getMention() === $this) {
                $parcour->setMention(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bloc>
     */
    public function getBlocs(): Collection
    {
        return $this->blocs;
    }

    public function addBloc(Bloc $bloc): static
    {
        if (!$this->blocs->contains($bloc)) {
            $this->blocs->add($bloc);
            $bloc->setMention($this);
        }

        return $this;
    }

    public function removeBloc(Bloc $bloc): static
    {
        if ($this->blocs->removeElement($bloc)) {
            // set the owning side to null (unless already changed)
            if ($bloc->getMention() === $this) {
                $bloc->setMention(null);
            }
        }

        return $this;
    }

    public function getComposante(): ?Composante
    {
        return $this->composante;
    }

    public function setComposante(?Composante $composante): static
    {
        $this->composante = $composante;

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
            $ressource->setMention($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getMention() === $this) {
                $ressource->setMention(null);
            }
        }

        return $this;
    }
}
