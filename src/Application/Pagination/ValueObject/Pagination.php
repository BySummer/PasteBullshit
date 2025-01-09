<?php

namespace App\Application\Pagination\ValueObject;

class Pagination
{
    protected int $totalCount;
    protected int $pageSize;
    protected int $page = 1;
    protected int $defaultPageSize = 25;
    /** @var int[] */
    protected array $pageSizeLimit = [1, 100];

    /**
     * Pagination constructor.
     * @param int     $totalCount
     */
    public function __construct(int $totalCount)
    {
        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getPageCount(): int
    {
        return (int) (($this->totalCount + $this->getPageSize() - 1) / $this->getPageSize());
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return Pagination
     */
    public function setPage(int $page): Pagination
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return ($this->pageSize ?? $this->defaultPageSize);
    }

    /**
     * @param int $pageSize
     * @return Pagination
     */
    public function setPageSize(int $pageSize): Pagination
    {
        if ($pageSize < $this->pageSizeLimit[0]) {
            $this->pageSize = $this->pageSizeLimit[0];
        } elseif ($pageSize > $this->pageSizeLimit[1]) {
            $this->pageSize = $this->pageSizeLimit[1];
        } else {
            $this->pageSize = $pageSize;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->getPageCount() > 0 ? (int) (($this->getPage() - 1) * $this->getPageSize()) : 0;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->getPageSize();
    }

}