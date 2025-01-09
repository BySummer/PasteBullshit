<?php

namespace App\Entity;

use App\Infrastructure\Doctrine\Column\CreatedAt;
use App\Repository\PasteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PasteRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Paste
{
    use CreatedAt;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="smallint")
     */
    private $visibility;

    /**
     * @ORM\Column(type="smallint")
     */
    private $syntax;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $uuid;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expiredAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getVisibility(): ?int
    {
        return $this->visibility;
    }

    public function setVisibility(int $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getSyntax(): ?int
    {
        return $this->syntax;
    }

    public function setSyntax(int $syntax): self
    {
        $this->syntax = $syntax;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?\DateTimeInterface $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }
}
