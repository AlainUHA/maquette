<?php

namespace App\Entity;

use App\Repository\ApprentissageCritiqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprentissageCritiqueRepository::class)]
class ApprentissageCritique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'apprentissageCritiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bloc $bloc = null;

    #[ORM\Column(length: 150)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'apprentissageCritiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveau $niveau = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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
}
