<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route(path: '/todo', name: 'app_todo', methods: ['GET'])]
    public function list(): Response
    {
        return new Response('Welcome to Latte and Code ');
    }
}
