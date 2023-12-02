<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Music::class)]
    private Collection $musics;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne]
    private ?Style $style = null;

    #[ORM\ManyToMany(targetEntity: Fan::class)]
    private Collection $fans;

    #[ORM\ManyToOne]
    private ?Artist $artist = null;


    public function __construct()
    {
        $this->musics = new ArrayCollection();
        $this->fans = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Music>
     */
    public function getMusics(): Collection
    {
        return $this->musics;
    }

    public function addMusic(Music $music): static
    {
        if (!$this->musics->contains($music)) {
            $this->musics->add($music);
            $music->setAlbum($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): static
    {
        if ($this->musics->removeElement($music)) {
            // set the owning side to null (unless already changed)
            if ($music->getAlbum() === $this) {
                $music->setAlbum(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): static
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return Collection<int, Fan>
     */
    public function getFans(): Collection
    {
        return $this->fans;
    }

    public function addFan(Fan $fan): static
    {
        if (!$this->fans->contains($fan)) {
            $this->fans->add($fan);
        }

        return $this;
    }

    public function removeFan(Fan $fan): static
    {
        $this->fans->removeElement($fan);

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): static
    {
        $this->artist = $artist;

        return $this;
    }


}
