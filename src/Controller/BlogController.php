<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repository)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        
        $articles = $repository->findAll();

        return $this->render('blog/index.html.twig', [
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'BlogController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'blog',
            //Variable pour le titre
            'title' => 'Blog',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     */
    public function create()
    {
        $article = new Article();

        return $this->render('blog/create.html.twig', [
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'BlogController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'blog',
            //Variable pour le titre
            'title' => 'Création article',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4'
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
            //Permet d'afficher le nom du contrôlleur
            'controller_name' => 'BlogController',
            //Permet d'avoir le link de la navbar en active
            'current_menu' => 'blog',
            //Variable pour le titre
            'title' => 'Blog',
            //Titre de l'application
            'appName' => 'StarterKit Symfony 4',
            
            'article' => $article,
        ]);
    }
}
