<?php
namespace App\Controller;

//use App\Entity\BlogPost;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * This route has a greedy pattern and is defined first.
     */
    #[Route('/blog/{slug}', name: 'blog_show')]
    //public function show(BlogPost $post): Response
    public function show(string $slug): Response
    {
        return $this->render('base.html.twig');
    }

    /**
     * This route could not be matched without defining a higher priority than 0.
     */
    #[Route('/blog/list', name: 'blog_list', priority: 2)]
    public function list(): Response
    {
        return $this->render('base.html.twig');
    }
}