<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpaceStationRepository")
 */
class SpaceStation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Organisation", mappedBy="spacestation")
     */
    private $organisations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Astronaut", mappedBy="spaceStation")
     */
    private $astronauts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Position", mappedBy="spaceStation")
     */
    private $positions;

    public function __construct()
    {
        $this->organisations = new ArrayCollection();
        $this->astronauts = new ArrayCollection();
        $this->positions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Organisation[]
     */
    public function getOrganisations(): Collection
    {
        return $this->organisations;
    }

    public function addOrganisations(Organisation $organisation): self
    {
        if (!$this->organisations->contains($organisation)) {
            $this->organisations[] = $organisation;
            $organisations->setSpacestation($this);
        }

        return $this;
    }

    public function removeOrganisations(Organisation $organisation): self
    {
        if ($this->organisations->contains($organisation)) {
            $this->organisations->removeElement($organisation);
            // set the owning side to null (unless already changed)
            if ($organisations->getSpacestation() === $this) {
                $organisations>setSpacestation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function getAstronauts(): Collection
    {
        return $this->astronauts;
    }

    public function addAstronaut(Astronaut $astronaut): self
    {
        if (!$this->astronauts->contains($astronaut)) {
            $this->astronauts[] = $astronaut;
            $astronaut->setSpaceStation($this);
        }

        return $this;
    }

    public function removeAstronaut(Astronaut $astronaut): self
    {
        if ($this->astronauts->contains($astronaut)) {
            $this->astronauts->removeElement($astronaut);
            // set the owning side to null (unless already changed)
            if ($astronaut->getSpaceStation() === $this) {
                $astronaut->setSpaceStation(null);
            }
        }

        return $this;
    }
}
