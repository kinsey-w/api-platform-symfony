<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[Vich\Uploadable]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['media:read']]),
        new Post(
            denormalizationContext: ['groups' => ['media:write']],
            validationContext: ['groups' => ['Default', 'media:create']],
            security: "is_granted('ROLE_ADMIN')",
        )
    ]
)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['media:read', 'movie:read'])]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'media_object', fileNameProperty: 'filePath')]
    #[Groups(['media:write'])]
    private ?File $file = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['media:read', 'movie:read'])]
    private ?string $filePath = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'poster', cascade: ['persist'])]
    private ?Movie $movie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;

        if ($file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getContentUrl(): ?string
    {
        return $this->filePath ? '/uploads/media/' . $this->filePath : null;
    }

    #[Groups(['media:read', 'movie:read'])]
    public function getUrl(): ?string
    {
        return $this->getContentUrl();
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): static
    {
        $this->movie = $movie;
        return $this;
    }
}
