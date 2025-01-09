<?php

namespace App\UI\Controller\MainPage\Output;

use App\Application\Paste\PasteModel;
use App\Entity\Paste;

class OutputService
{
    public function getData(Paste $paste): array
    {
        return [
            'name'      => $paste->getName(),
            'syntax'    => PasteModel::getSyntaxName($paste->getSyntax()),
            'expiredAt' => $paste->getExpiredAt(),
            'createdAt' => $paste->getCreatedAt(),
        ];
    }
}