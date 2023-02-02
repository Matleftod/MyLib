<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyBooksController extends AbstractController
{
    #[Route('/api/mybooks', name: 'app_my_books')]
    public function index(): Response
    {
        return $this->render('my_books/index.html.twig', [
            'controller_name' => 'MyBooksController',
        ]);
    }
}
