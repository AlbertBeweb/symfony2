<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'ContactController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'contact',
            //Variable pour le titre
            'title' => 'Contact',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4'
        ]);
    }
}
