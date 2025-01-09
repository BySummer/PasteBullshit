<?php

namespace App\Application\Paste\Dto;

use DateTimeInterface;

interface PasteInterface
{
    public function getName(): string;

    public function getContent(): string;

    public function getVisibility(): int;

    public function getSyntax(): int;

    public function getLifetime(): int;
}