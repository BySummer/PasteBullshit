<?php

namespace App\Application\Paste;

use App\Entity\Paste;

interface PasteRepositoryInterface
{
    public function getByHash(string $hash): ?Paste;
}