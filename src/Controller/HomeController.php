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
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'home',
            //Variable pour le titre et l'onglet
            'title' => 'Home',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4'
        ]);
    }
}
