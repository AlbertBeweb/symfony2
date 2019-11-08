<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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
     * @Route("/blog/{id}/edit", name="blog_edit")
     */
    public function form(Article $article = null, Request $request, ObjectManager $manager)
    {
        if(!$article)
        {
            $article = new Article();
        }
        
        /* 
        Avec la commande php bin/console make:form Symfony crée
        le fichier src/form/ArticleType
        $form = $this->createFormBuilder($article)
                     ->add('title')
                     ->add('content')
                     ->add('image')
                     ->getForm(); */

        $form =$this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            if(!$article->getId())
            {

                $article->setCreateAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'editMode' => $article->getId() !== null,
            //Permet de récupéré la vue du formulaire
            'formArticle' => $form->createView(),
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
    public function show(Article $article, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $comment->setCreateAt(new \DateTime())
                    ->setArticle($article);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

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
            'commentForm' => $form->createView(),
        ]);
    }
}
