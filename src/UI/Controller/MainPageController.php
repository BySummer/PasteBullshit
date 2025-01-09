<?php

namespace App\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainPageController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('main/index.html.twig');
    }
}