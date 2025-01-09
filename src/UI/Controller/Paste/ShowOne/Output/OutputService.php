<?php

namespace App\UI\Controller\Paste\ShowOne\Output;

use App\Application\Paste\PasteModel;
use App\Entity\Paste;

class OutputService
{
    public function getData(Paste $paste): array
    {
        return [
            'name'            => $paste->getName(),
            'content'         => nl2br(htmlspecialchars($paste->getContent())),
            'visibility'      => PasteModel::getVisibilityName($paste->getVisibility()),
            'expiredAt'       => $paste->getExpiredAt(),
            'syntax'          => PasteModel::getSyntaxName($paste->getSyntax()),
            'syntaxHighlight' => $paste->getSyntax() !== PasteModel::SYNTAX_NONE,
        ];
    }
}