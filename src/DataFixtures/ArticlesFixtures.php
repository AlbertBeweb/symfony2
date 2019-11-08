<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 3; $i++)
        {
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());

            $manager->persist($category);

            $content =  '<p>' . join($faker->paragraphs(4), '</p><p>') . '</p>';

        for ($j = 1; $j <= mt_rand(4, 6); $j++) {
            $article = new Article();
            $article->setTitle($faker->sentence())
                ->setContent($content)
                ->setImage($faker->imageUrl())
                ->setCreateAt($faker->dateTimeBetween('-6 months'))
                ->setCategory($category);

            $manager->persist($article);

        for($k = 1; $k <= mt_rand(4, 10); $k++)
        {
            $comment = new Comment();

            $content =  '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';

            $days = (new \DateTime())->diff($article->getCreateAt())->days;

            $comment->setAuthor($faker->name)
                    ->setContent($content)
                    ->setCreateAt($faker->dateTimeBetween('-' . $days . ' days'))
                    ->setArticle($article);

            $manager->persist($comment);
        }

        }

        }

        $manager->flush();
    }
}
