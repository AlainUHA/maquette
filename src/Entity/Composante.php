<?php

namespace App\Entity;

use App\Repository\ComposanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComposanteRepository::class)]
class Composante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Mention>
     */
    #[ORM\OneToMany(targetEntity: Mention::class, mappedBy: 'composante')]
    private Collection $mentions;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\OneToMany(targetEntity: Utilisateur::class, mappedBy: 'composante')]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->mentions = new ArrayCollection();
        $this->utilisateurs = new ArrayCollection();
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
     * @return Collection<int, Mention>
     */
    public function getMentions(): Collection
    {
        return $this->mentions;
    }

    public function addMention(Mention $mention): static
    {
        if (!$this->mentions->contains($mention)) {
            $this->mentions->add($mention);
            $mention->setComposante($this);
        }

        return $this;
    }

    public function removeMention(Mention $mention): static
    {
        if ($this->mentions->removeElement($mention)) {
            // set the owning side to null (unless already changed)
            if ($mention->getComposante() === $this) {
                $mention->setComposante(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setComposante($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getComposante() === $this) {
                $utilisateur->setComposante(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs2(): Collection
    {
        return $this->utilisateurs2;
    }

    public function addUtilisateurs2(Utilisateur $utilisateurs2): static
    {
        if (!$this->utilisateurs2->contains($utilisateurs2)) {
            $this->utilisateurs2->add($utilisateurs2);
            $utilisateurs2->setComposante($this);
        }

        return $this;
    }

    public function removeUtilisateurs2(Utilisateur $utilisateurs2): static
    {
        if ($this->utilisateurs2->removeElement($utilisateurs2)) {
            // set the owning side to null (unless already changed)
            if ($utilisateurs2->getComposante() === $this) {
                $utilisateurs2->setComposante(null);
            }
        }

        return $this;
    }
}
