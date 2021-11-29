<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $genre1 = new Genre();
        $genre1->setType("Drame");
        $manager->persist($genre1);

        $genre2 = new Genre();
        $genre2->setType("Comédie");
        $manager->persist($genre2);

        $manager->flush();
    }
}
