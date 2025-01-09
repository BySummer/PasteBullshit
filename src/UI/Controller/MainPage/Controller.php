<?php

namespace App\UI\Controller\MainPage;

use App\Application\Pagination\PaginationMaker;
use App\Application\Pagination\PaginationParam;
use App\Application\Search\Manager\SearchManager;
use App\Application\Search\ValueObject\SearchQuery\Paste\SearchQuery;
use App\UI\Controller\MainPage\Dto\PasteParam;
use App\UI\Controller\MainPage\Output\OutputService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function __construct(
        private readonly SearchManager   $searchManager,
        private readonly PaginationMaker $paginationMaker,
        private readonly OutputService   $outputService
    ) {}

    public function __invoke(Request $request): Response
    {
        $searchParam = new PasteParam();
        $searchQuery = $this->searchManager->createSearchQuery($searchParam, SearchQuery::class);

        $pagination = $this->paginationMaker->createPagination(
            $searchQuery->getTotalCount(),
            $request->query->get(PaginationParam::PARAM_PAGE, 1)
        );
        $pagination->setPageSize(10);

        $searchQuery->setLimit($pagination->getLimit())
                    ->setOffset($pagination->getOffset());

        $pastesOutput = [];
        foreach ($searchQuery->getResults() as $pastes) {
            $pastesOutput[] = $this->outputService->getData($pastes);
        }

        return $this->render('main/index.html.twig', [
            'pastesOutput' => $pastesOutput,
            'pagination'   => $pagination,
        ]);
    }
}