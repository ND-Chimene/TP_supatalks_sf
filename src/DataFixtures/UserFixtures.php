<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');

        // $user = new User();
        // $user
        //     ->setEmail($faker->email)
        //     ->setPassword('$2y$13$NJpGg/WaTYG0ONkZkf6tvuPVmkuexwRQqozQKsp5b8yc9z9B3ziMG') // admin
        //     ->setRoles(['ROLE_ADMIN'])
        // ;
        // $this->addReference('user_admin', $user);
        // $manager->persist($user);

        // $manager->flush();
    }
}
