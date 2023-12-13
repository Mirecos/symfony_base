<?php

namespace App\Entity;


use App\Enum\AlbumStatus;
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

    #[ORM\Column(length: 30, enumType: AlbumStatus::class)]
    private ?AlbumStatus $status = null;

    
    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Music::class)]
    private Collection $musics;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne]
    private ?Style $style = null;

    #[ORM\ManyToOne]
    private ?Artist $artist = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Cover $Cover = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'liked')]
    private Collection $Fans;


    public function __construct()
    {
        $this->musics = new ArrayCollection();
        $this->fans = new ArrayCollection();
        $this->Fans = new ArrayCollection();
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


    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

    public function getStatus(): ?AlbumStatus
    {
        return $this->status;
    }

    public function setStatus(?AlbumStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCover(): ?Cover
    {
        return $this->Cover;
    }

    public function setCover(?Cover $Cover): static
    {
        $this->Cover = $Cover;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFans(): Collection
    {
        return $this->Fans;
    }

    public function addFan(User $fan): static
    {
        if (!$this->Fans->contains($fan)) {
            $this->Fans->add($fan);
        }

        return $this;
    }

    public function removeFan(User $fan): static
    {
        $this->Fans->removeElement($fan);

        return $this;
    }
}
