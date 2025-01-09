<?php

namespace App\UI\Controller\Paste\ShowOne;

use App\Application\Paste\PasteRepositoryInterface;
use App\UI\Controller\Paste\ShowOne\Output\OutputService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends AbstractController
{
    public function __construct(
        private readonly PasteRepositoryInterface $pasteRepository,
        private readonly OutputService            $outputService,
    ) {}

    public function __invoke(Request $request, string $hash): Response
    {
        $paste = $this->pasteRepository->getByHash($hash);
        if (is_null($paste)) {
            throw new NotFoundHttpException();
        }

        $now = new DateTime();
        if (!is_null($paste->getExpiredAt()) && $paste->getExpiredAt() <= $now) {
            throw new AccessDeniedHttpException();
        }

        return $this->render('main/paste/show.html.twig', [
            'paste' => $this->outputService->getData($paste),
        ]);
    }
}