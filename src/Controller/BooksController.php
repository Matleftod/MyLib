<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Books;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BooksRepository;

class BooksController extends AbstractController
{
    /*#[Route('/books/index', name: 'app_books')]
    public function index(): Response
    {
        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }
    
    #[Route('/books', name: 'app_books')]
    public function createBooks(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $books = new Books();
        $books->setTitle('Titre2');
        $books->setAuthor('Auteur2');
        $books->setPrice(9);

        // tell Doctrine you want to (eventually) save the Books (no queries yet)
        $entityManager->persist($books);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new books with id '.$books->getId());
    }*/

    #[Route('/books/{id}', name: 'books_show')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $books = $doctrine->getRepository(Books::class)->find($id);

        if (!$books) {
            throw $this->createNotFoundException(
                'No books found for id '.$id
            );
        }

        return new Response('Check out this great books: '.$books->getTitle());

        // or render a template
        // in the template, print things with {{ books.name }}
        // return $this->render('books/show.html.twig', ['books' => $books]);
    }

    #[Route('/books/all', name: 'books_show')]
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $minPrice = 1;
        
        $books = $doctrine->getRepository(Books::class)->findAllGreaterThanPrice($minPrice);
        
        if (!$books) {
            throw $this->createNotFoundException(
                'No books found for min price : ' . $minPrice
            );
        }
        $res = "Book(s) under " . $minPrice . "$ : </br>";
        foreach($books as $book){
            $res .= ' Check out this great books: '. $book->getTitle() . "</br>";
        }
        return new Response($res);

        // or render a template
        // in the template, print things with {{ books.name }}
        // return $this->render('books/show.html.twig', ['books' => $books]);
    }

    #[Route('/books/edit/{id}', name: 'books_edit')]
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $books = $entityManager->getRepository(Books::class)->find($id);

        if (!$books) {
            throw $this->createNotFoundException(
                'No books found for id '.$id
            );
        }

        $books->setTitle('New books title !');
        $entityManager->flush();

        return $this->redirectToRoute('books_show', [
            'id' => $books->getId()
        ]);
    }
}
