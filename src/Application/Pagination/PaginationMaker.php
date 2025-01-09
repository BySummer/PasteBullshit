<?php

namespace App\Application\Pagination;

use App\Application\Pagination\ValueObject\Pagination;

class PaginationMaker
{
    /**
     * @param int $totalCount
     * @param int $currentPage
     * @return Pagination
     */
    public function createPagination(int $totalCount, int $currentPage): Pagination
    {
        return (new Pagination($totalCount))
            ->setPage($currentPage);
    }
}