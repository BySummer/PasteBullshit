<?php

namespace App\Application\Param\Dto;

interface ParamInterface
{
    public const SORT_DESC = 'DESC';
    public const SORT_ASC  = 'ASC';

    public const ID        = 'id';
    public const PLAYER    = 'player';
    public const SERVER    = 'server';
    public const TYPE      = 'type';
    public const DEVICE_OS = 'device_os';
    public const DEVICE_ID = 'device_id';
    public const XUID      = 'xuid';
    public const DATE_FROM = 'date_from';
    public const DATE_TO   = 'date_to';

    public function getParams(): array;
}