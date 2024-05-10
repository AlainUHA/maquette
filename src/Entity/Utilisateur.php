<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_MAIL', fields: ['mail'])]
#[UniqueEntity(fields: ['mail'], message: 'There is already an account with this mail')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $prenom = null;

    #[ORM\Column(length: 40)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $mail = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Mention>
     */
    #[ORM\OneToMany(targetEntity: Mention::class, mappedBy: 'resp')]
    private Collection $mentions;

    /**
     * @var Collection<int, AccesMention>
     */
    #[ORM\OneToMany(targetEntity: AccesMention::class, mappedBy: 'utilisateur')]
    private Collection $accesMentions;

    /**
     * @var Collection<int, Parcours>
     */
    #[ORM\OneToMany(targetEntity: Parcours::class, mappedBy: 'resp')]
    private Collection $parcours;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Composante $composante = null;


    public function __construct()
    {
        $this->mentions = new ArrayCollection();
        $this->accesMentions = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->mail;
    }

    public function getNomComplet(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $mention->setResp($this);
        }

        return $this;
    }

    public function removeMention(Mention $mention): static
    {
        if ($this->mentions->removeElement($mention)) {
            // set the owning side to null (unless already changed)
            if ($mention->getResp() === $this) {
                $mention->setResp(null);
            }
        }

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
            $accesMention->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAccesMention(AccesMention $accesMention): static
    {
        if ($this->accesMentions->removeElement($accesMention)) {
            // set the owning side to null (unless already changed)
            if ($accesMention->getUtilisateur() === $this) {
                $accesMention->setUtilisateur(null);
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

    public function addParcour(Parcours $parcour): static
    {
        if (!$this->parcours->contains($parcour)) {
            $this->parcours->add($parcour);
            $parcour->setResp($this);
        }

        return $this;
    }

    public function removeParcour(Parcours $parcour): static
    {
        if ($this->parcours->removeElement($parcour)) {
            // set the owning side to null (unless already changed)
            if ($parcour->getResp() === $this) {
                $parcour->setResp(null);
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
}
