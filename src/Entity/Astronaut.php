<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AstronautRepository")
 */
class Astronaut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SpaceStation", inversedBy="astronauts")
     */
    private $spaceStation;

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

    public function getSpaceStation(): ?SpaceStation
    {
        return $this->spaceStation;
    }

    public function setSpaceStation(?SpaceStation $spaceStation): self
    {
        $this->spaceStation = $spaceStation;

        return $this;
    }
}
