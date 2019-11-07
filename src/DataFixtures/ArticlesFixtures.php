<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++)
        {
            $article = new Article();
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("Contenu de l'article n°$i")
                    ->setImage("https://via.placeholder.com/350x150/")
                    ->setCreateAt(new \DateTime());

            $manager->persist($article);
        }
            $manager->flush();
    }
}