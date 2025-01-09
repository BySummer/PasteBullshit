<?php

namespace App\Application\Param\Dto;

interface ParamInterface
{
    public const SORT_DESC = 'DESC';
    public const SORT_ASC  = 'ASC';

    public const VISIBILITY = 'visibility';

    public function getParams(): array;
}