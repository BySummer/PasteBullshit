<?php

namespace App\UI\Controller\MainPage\Dto;

use App\Application\Param\Dto\ParamInterface;
use App\Application\Paste\PasteModel;

class PasteParam implements ParamInterface
{
    public function getParams(): array
    {
        return [
            self::VISIBILITY => PasteModel::VISIBILITY_PUBLIC
        ];
    }
}