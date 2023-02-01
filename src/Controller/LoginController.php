<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

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
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'email'  => $user->getUserIdentifier(),
        ]);
    }
}