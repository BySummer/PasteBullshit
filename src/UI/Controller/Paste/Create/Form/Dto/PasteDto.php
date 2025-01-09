<?php

namespace App\UI\Controller\Paste\Create\Form\Dto;

use App\Application\Paste\Dto\PasteInterface;

class PasteDto implements PasteInterface
{
    public function __construct(
        private readonly string $name,
        private readonly string $content,
        private readonly int    $visibility,
        private readonly int    $syntax,
        private readonly int    $lifetime
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getVisibility(): int
    {
        return $this->visibility;
    }

    public function getSyntax(): int
    {
        return $this->syntax;
    }

    public function getLifetime(): int
    {
        return $this->lifetime;
    }
}