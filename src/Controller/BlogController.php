<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'AboutController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'blog',
            //Variable pour le titre
            'title' => 'Blog',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4'
        ]);
    }
}
