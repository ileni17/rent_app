<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController {

    /**
     * @Route("/home")
     */
    public function home() : Response
    {
        return new Response('Dobar dan');
    }
}

