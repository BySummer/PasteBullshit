<?php

namespace App\Application\Search\ValueObject\SearchQuery;

interface SearchQueryInterface
{
    /**
     * @return mixed
     */
    public function getResults();

    /**
     * @return int
     */
    public function getTotalCount(): int;

    /**
     * @param int|null $limit
     * @return mixed
     */
    public function setLimit(?int $limit): self;

    /**
     * @param int|null $offset
     * @return mixed
     */
    public function setOffset(?int $offset): self;

}