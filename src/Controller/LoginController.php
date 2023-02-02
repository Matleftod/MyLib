<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Doctrine\Persistence\ManagerRegistry;

class LoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/api/authenUser", name="authenticated-user", methods={"GET"})
     */
    public function getAuthenUser(#[CurrentUser] ?User $user)
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
                'email'  => 'none',
                'is_premium'  => false,
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'email'  => $user->getUserIdentifier(),
            'is_premium'  => $user->isIsPremium(),
        ]);
    }

    /**
     * @Route("/api/setPremium", name="set-premium", methods={"PATCH"})
     */
    public function setPremiumUser(#[CurrentUser] ?User $user, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->setIsPremium(true);
        $entityManager->persist($user);
        $entityManager->flush();

        $data =  [
            'is_premium' => $user->isIsPremium(),
        ];

        return $this->json($data);

    }
}