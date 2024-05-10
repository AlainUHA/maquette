<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GradeRepository::class)]
class Grade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $grade = null;

    /**
     * @var Collection<int, Mention>
     */
    #[ORM\OneToMany(targetEntity: Mention::class, mappedBy: 'grade')]
    private Collection $mentions;

    public function __construct()
    {
        $this->mentions = new ArrayCollection();
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

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

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
            $mention->setGrade($this);
        }

        return $this;
    }

    public function removeMention(Mention $mention): static
    {
        if ($this->mentions->removeElement($mention)) {
            // set the owning side to null (unless already changed)
            if ($mention->getGrade() === $this) {
                $mention->setGrade(null);
            }
        }

        return $this;
    }
}
