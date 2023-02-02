<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

use Stripe;

class StripeController extends AbstractController
{
  #[Route('/stripe', name: 'app_stripe')]
  public function index(#[CurrentUser] ?User $user, ManagerRegistry $doctrine, LoggerInterface $logger)
  {  
    Stripe\Stripe::setApiKey('pk_test_51MWy46Jv9xCelsB6yhoSeLWVtaU0S04zHLGLESTHblIycB5XvMwgiteGgGiNPrVfDZdck4FcLsN8Dmji35e9xCaK00rwBdSk42');
    // Replace this endpoint secret with your endpoint's unique secret
    // If you are using an endpoint defined with the API or dashboard, look in your webhook settings
    // at https://dashboard.stripe.com/webhooks
    $endpoint_secret = 'whsec_971a56d4a2b47188c5ed951f1a003de4db4c3a309d7a654a42fc519b1cd9d81c';
    
    $payload = @file_get_contents('php://input');
    $event = null;
    $entityManager = $doctrine->getManager();
    
    try {
      $event = \Stripe\Event::constructFrom(
        json_decode($payload, true)
      );
    } catch(\UnexpectedValueException $e) {
      // Invalid payload
      echo '⚠️  Webhook error while parsing basic request.';
      http_response_code(400);
      exit();
    }
    if ($endpoint_secret) {
      // Only verify the event if there is an endpoint secret defined
      // Otherwise use the basic decoded event
      $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
      try {
        $event = \Stripe\Webhook::constructEvent(
          $payload, $sig_header, $endpoint_secret
        );
      } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        echo '⚠️ Webhook error while validating signature.';
        http_response_code(400);
        exit();
      }
    }
    
    // Handle the event
    switch ($event->type) {
      case 'checkout.session.completed':
        $logger->info('I just got the logger AAAAAAAAAAAA');
        $user->setIsPremium(true);
        $entityManager->persist($user);
        $entityManager->flush();
        break;
      default:
        // Unexpected event type
        error_log('Received unknown event type');
    }
    http_response_code(200);
  }
}
