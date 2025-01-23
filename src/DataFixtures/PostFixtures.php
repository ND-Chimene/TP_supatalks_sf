<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user = $this->getReference('user_admin');
        for ($i=1; $i < 21; $i++) {
            $post = new Post();
            $post
                ->setRef(uniqid())
                ->setTitle($faker->sentence(3))
                ->setContent($faker->paragraph(5))
                ->setImage('https://picsum.photos/1280/720?random=' . $i)
                ->setIsPublished($faker->boolean(50))
                ->setUser($user)
            ;
            $this->addReference('post-'.$i, $post);
            $manager->persist($post);
        }

        $manager->flush();
    }
}
