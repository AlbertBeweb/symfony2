<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('pages/home.html.twig', [
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'HomeController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'home',
            //Variable pour le titre
            'title' => 'Home',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4'
        ]);
    }
}
