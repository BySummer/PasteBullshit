<?php

namespace App\Application\Search\ValueObject\SearchQuery;

use App\Application\Param\Dto\ParamInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

abstract class SearchQueryAbstract implements SearchQueryInterface
{
    protected ParamInterface $searchParam;
    protected QueryBuilder $queryBuilder;

    /**
     * SearchQuery constructor.
     * @param ParamInterface $searchParam
     * @param QueryBuilder   $queryBuilder
     */
    public function __construct(ParamInterface $searchParam, QueryBuilder $queryBuilder)
    {
        $this->searchParam = $searchParam;

        $this->initQueryBuilder($queryBuilder);
    }

    abstract protected function initQueryBuilder(QueryBuilder $queryBuilder);

    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    /**
     * @return Query
     */
    public function getQuery(): Query
    {
        return $this->getQueryBuilder()->getQuery();
    }

    /**
     * @return mixed|void
     */
    public function getResults()
    {
        return $this->getQuery()->execute();
    }

    /**
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getTotalCount(): int
    {
        $rootAliases = $this->getQueryBuilder()->getRootAliases();

        return (int) (clone $this->getQueryBuilder())
            ->select('COUNT(DISTINCT ' . $rootAliases[0] . ')')
            ->resetDQLPart('groupBy')
            ->setFirstResult(null)
            ->setMaxResults(null)
            ->getQuery()->getSingleScalarResult();
    }

    /**
     * @param int|null $limit
     * @return $this|mixed
     */
    public function setLimit(?int $limit): SearchQueryInterface
    {
        $this->getQueryBuilder()->setMaxResults($limit);

        return $this;
    }

    /**
     * @param int|null $offset
     * @return $this|mixed
     */
    public function setOffset(?int $offset): SearchQueryInterface
    {
        $this->getQueryBuilder()->setFirstResult($offset);

        return $this;
    }
}