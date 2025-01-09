<?php

namespace App\UI\Controller\Paste\Create;

use App\Application\Paste\PasteManager;
use App\UI\Controller\Paste\Create\Form\Form;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Controller extends AbstractController
{
    public function __construct(
        private readonly PasteManager $pasteManager,
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(Form::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            try {
                $this->pasteManager->create($dto);
                $this->addFlash('success', 'Паста успешно создана');

                return $this->redirectToRoute('home');
            } catch (Throwable $e) {
                $this->logger->error('Ошибка при создании пасты', [
                    'exception' => $e,
                ]);
                $this->addFlash('error', 'Ошибка при создании пасты');
            }
        }

        return $this->render('main/paste/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}