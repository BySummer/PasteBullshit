<?php

namespace App\Infrastructure\Twig;

use App\Application\Pagination\PaginationParam;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class PaginationExtension
 * @package App\Infrastructure\Twig
 */
class PaginationExtension extends AbstractExtension
{
    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_pagination_page_param', [$this, 'getPaginationPageParam']),
        ];
    }

    /**
     * @return string
     */
    public function getPaginationPageParam(): string
    {
        return PaginationParam::PARAM_PAGE;
    }
}