<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\UserBooks;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Doctrine\Persistence\ManagerRegistry;

class MyBooksController extends AbstractController
{
    #[Route('/api/mybooks', name: 'app_my_books')]
    public function index()
    {
        
    }
/*
    #[Route('/api/mybooks/add', name: 'add_books_to_user')]
    public function addBookToUser(#[CurrentUser] ?User $user, ManagerRegistry $doctrine, UserBooks $userBooks, $bookTitle, $bookAuthor)
    {
        $entityManager = $doctrine->getManager();

        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }
        else{
            $userBooks->addUserId($user->getId());
            $userBooks->setTitle($bookTitle);
            $userBooks->setAuthor($bookAuthor);

            $entityManager->persist($userBooks);
            $entityManager->flush();
    
            $data =  [
                'isOk' => 'ok!',
            ];
    
            return $this->json($data);
        }
    }*/

    #[Route('/api/mybooks/get', name: 'get_books_to_user')]
    public function getBookToUser(ManagerRegistry $doctrine, #[CurrentUser] ?User $user)
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
                'email'  => 'none',
                'is_premium'  => false,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $userBooks = $doctrine
            ->getRepository(UserBooks::class)
            ->findAll();
  
        $data = [];
  
        foreach ($userBooks as $userBook) {
           $data[] = [
               'id' => $userBook->getId(),
               'title' => $userBook->getTitle(),
               'author' => $userBook->getAuthor(),
               'userId' => $userBook->getUserId(),
           ];
        }
  
        return $this->json($data);
    }

   
    #[Route('/api/mybooks/delete/{id}', name: 'delete_books_to_user')]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $userBook = $entityManager->getRepository(UserBooks::class)->find($id);
  
        if (!$userBook) {
            return $this->json('No userBook found for id' . $id, 404);
        }
  
        $entityManager->remove($userBook);
        $entityManager->flush();
  
        return $this->json('Deleted a userBook successfully with id ' . $id);
    }
}
