<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ApiLoginController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/api/login_check", name="login-check", methods={"POST"})
     * @param JWTTokenManagerInterface $JWTManager
     * @return JsonResponse
     */
    public function index(#[CurrentUser] ?User $user, $JWTManager): JsonResponse
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = new JsonResponse(['token' => $JWTManager->create($user)]); // somehow create an API token for $user

        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }

    // #[Route('/api/login', name: 'app_api_login')]
    // public function index(#[CurrentUser] ?User $user): Response
    // {
    //     if (null === $user) {
    //         return $this->json([
    //             'message' => 'missing credentials',
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }

    //     $token = $this->getTokenUser($user, $em); // somehow create an API token for $user
    
    //     return $this->json([
    //         'user'  => $user->getUserIdentifier(),
    //         'token' => $token,
    //     ]);
    // }
}