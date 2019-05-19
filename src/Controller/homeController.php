<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $posts ="sam";

        return $this->render('index.html.twig', [
            'posts' => $posts,
        ]);
    }
}