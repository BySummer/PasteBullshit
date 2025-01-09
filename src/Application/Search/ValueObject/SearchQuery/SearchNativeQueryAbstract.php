<?php

namespace App\Application\Search\ValueObject\SearchQuery;

use App\Application\Param\Dto\ParamInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NativeQuery;

abstract class SearchNativeQueryAbstract implements SearchQueryInterface
{

    protected ParamInterface $searchParam;
    protected EntityManager $_em;

    protected ?int $limit;
    protected ?int $offset;

    /**
     * SearchQuery constructor.
     * @param ParamInterface $searchParam
     * @param EntityManager  $_em
     */
    public function __construct(ParamInterface $searchParam, EntityManager $_em)
    {
        $this->searchParam = $searchParam;
        $this->_em         = $_em;
    }

    /**
     * @return NativeQuery
     */
    abstract protected function getNativeQuery(): NativeQuery;

    /**
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    abstract public function getTotalCount(): int;

    /**
     * @return EntityManager
     */
    protected function getEntityManager(): EntityManager
    {
        return $this->_em;
    }

    /**
     * @return mixed|void
     */
    public function getResults()
    {
        return $this->getNativeQuery()->getResult();
    }

    /**
     * @param int|null $limit
     * @return $this|mixed
     */
    public function setLimit(?int $limit): SearchQueryInterface
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int|null $offset
     * @return $this|mixed
     */
    public function setOffset(?int $offset): SearchQueryInterface
    {
        $this->offset = $offset;
        return $this;
    }
}