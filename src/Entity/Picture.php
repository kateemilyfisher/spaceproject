<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $mediaType;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $explanation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getMediaType(): ?string
    {
      return $this->mediaType;
    }

    public function setMediaType(?string $mediaType): self
    {
      $this->mediaType = $mediaType;

      return $this;
    }

    public function getExplanation(): ?string
    {
      return $this->explanation;
    }

    public function setExplanation(?string $explanation): self
    {
      $this->explanation = $explanation;

      return $this;
    }
}
