<?php

namespace App\Application\Search\ValueObject\SearchQuery\Paste;

use App\Application\Param\Dto\ParamInterface;
use App\Application\Search\ValueObject\SearchQuery\SearchQueryAbstract;
use App\Entity\Paste;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\QueryBuilder;

class SearchQuery extends SearchQueryAbstract
{
    /**
     * @throws QueryException
     */
    protected function initQueryBuilder(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->from(Paste::class, 'p')
                     ->select('p')
                     ->orderBy('p.id', ParamInterface::SORT_DESC);

        $searchParams = $this->searchParam->getParams();
        $criteria     = Criteria::create();

        if (!empty($searchParams[ParamInterface::VISIBILITY])) {
            $criteria->andWhere(Criteria::expr()->eq('p.visibility', $searchParams[ParamInterface::VISIBILITY]));
        }

        $criteria->andWhere(
            Criteria::expr()->gte('p.expiredAt', new \DateTime())
        );

        $queryBuilder->addCriteria($criteria);
        $this->queryBuilder = $queryBuilder;
    }
}