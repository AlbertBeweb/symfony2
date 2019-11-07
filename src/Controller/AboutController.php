<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index()
    {
        return $this->render('about/index.html.twig', [
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'AboutController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'about',
            //Variable pour le titre
            'title' => 'About',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4'
        ]);
    }
}
