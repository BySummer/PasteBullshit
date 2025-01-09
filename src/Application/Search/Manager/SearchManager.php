<?php

namespace App\Application\Search\Manager;

use App\Application\Param\Dto\ParamInterface;
use App\Application\Search\ValueObject\SearchQuery\SearchNativeQueryAbstract;
use App\Application\Search\ValueObject\SearchQuery\SearchQueryAbstract;
use App\Application\Search\ValueObject\SearchQuery\SearchQueryInterface;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;

class SearchManager
{
    private EntityManagerInterface $entityManager;

    /**
     * SearchManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ParamInterface       $searchParam
     * @param                      $searchQueryClass
     * @return SearchQueryInterface
     */
    public function createSearchQuery(ParamInterface $searchParam, $searchQueryClass): SearchQueryInterface
    {
        if (is_subclass_of($searchQueryClass, SearchQueryAbstract::class)) {
            return new $searchQueryClass($searchParam, $this->entityManager->createQueryBuilder());
        }
        if (is_subclass_of($searchQueryClass, SearchNativeQueryAbstract::class)) {
            return new $searchQueryClass($searchParam,  $this->entityManager);
        }

        throw new LogicException('Wrong usage');
    }
}