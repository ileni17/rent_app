<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    const ROUTE_HOMEPAGE = 'app_homepage';

    #[Route('/', name: self::ROUTE_HOMEPAGE)]
    public function index()
    {
        return $this->render('homepage.html.twig');
    }
}

