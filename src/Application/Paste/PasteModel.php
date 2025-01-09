<?php

namespace App\Application\Paste;

use LogicException;

class PasteModel
{
    public const NO_LIMIT_LIFETIME  = 1;
    public const ONE_HOUR_LIFETIME  = 2;
    public const ONE_DAY_LIFETIME   = 3;
    public const ONE_WEEK_LIFETIME  = 4;
    public const ONE_MONTH_LIFETIME = 5;

    private const NO_LIMIT_LIFETIME_NAME  = 'Без ограничений';
    private const ONE_HOUR_LIFETIME_NAME  = 'Один час';
    private const ONE_DAY_LIFETIME_NAME   = 'Один день';
    private const ONE_WEEK_LIFETIME_NAME  = 'Одна неделя';
    private const ONE_MONTH_LIFETIME_NAME = 'Один месяц';

    private const LIFETIME_NAMES = [
        self::NO_LIMIT_LIFETIME  => self::NO_LIMIT_LIFETIME_NAME,
        self::ONE_HOUR_LIFETIME  => self::ONE_HOUR_LIFETIME_NAME,
        self::ONE_DAY_LIFETIME   => self::ONE_DAY_LIFETIME_NAME,
        self::ONE_WEEK_LIFETIME  => self::ONE_WEEK_LIFETIME_NAME,
        self::ONE_MONTH_LIFETIME => self::ONE_MONTH_LIFETIME_NAME,
    ];

    public const VISIBILITY_PUBLIC   = 1;
    public const VISIBILITY_UNLISTED = 2;

    private const VISIBILITY_PUBLIC_NAME   = 'Публичный';
    private const VISIBILITY_UNLISTED_NAME = 'Только по ссылке';

    private const VISIBILITY_NAMES = [
        self::VISIBILITY_PUBLIC   => self::VISIBILITY_PUBLIC_NAME,
        self::VISIBILITY_UNLISTED => self::VISIBILITY_UNLISTED_NAME,
    ];

    private const SYNTAX_NONE       = 1;
    private const SYNTAX_PHP        = 2;
    private const SYNTAX_JAVASCRIPT = 3;

    private const SYNTAX_NONE_NAME       = 'Без языка';
    private const SYNTAX_PHP_NAME        = 'PHP';
    private const SYNTAX_JAVASCRIPT_NAME = 'JavaScript';

    private const SYNTAX_NAMES = [
        self::SYNTAX_NONE       => self::SYNTAX_NONE_NAME,
        self::SYNTAX_PHP        => self::SYNTAX_PHP_NAME,
        self::SYNTAX_JAVASCRIPT => self::SYNTAX_JAVASCRIPT_NAME,
    ];

    public static function getLifetimeNames(): array
    {
        return self::LIFETIME_NAMES;
    }

    public static function getVisibilityNames(): array
    {
        return self::VISIBILITY_NAMES;
    }

    public static function getSyntaxNames(): array
    {
        return self::SYNTAX_NAMES;
    }

    public static function getSyntaxName(int $type): string
    {
        if (!array_key_exists($type, self::SYNTAX_NAMES)) {
            throw new LogicException('Unknown type "' . $type . '"');
        }
        return self::SYNTAX_NAMES[$type];
    }
}