<?php

namespace App\Entity;

use App\Repository\AccesMentionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccesMentionRepository::class)]
class AccesMention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'accesMentions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'accesMentions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?mention $mention = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?role $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getMention(): ?mention
    {
        return $this->mention;
    }

    public function setMention(?mention $mention): static
    {
        $this->mention = $mention;

        return $this;
    }

    public function getRole(): ?role
    {
        return $this->role;
    }

    public function setRole(?role $role): static
    {
        $this->role = $role;

        return $this;
    }
}
