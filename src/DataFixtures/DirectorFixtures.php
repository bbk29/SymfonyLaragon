<?php

namespace App\DataFixtures;

use App\Entity\Director;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DirectorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $director1 = new Director();
        $director1->setPrenom("Agnès")
                ->setNom("Varda")
                ->setPhoto("https://is.gd/1JQRN7");
        $manager->persist($director1);

        $director2 = new Director();
        $director2->setPrenom("Kathryn")
                ->setNom("Bigelow")
                ->setPhoto("https://i.imgur.com/PZSEVO8.jpeg");
        $manager->persist($director2);

        $manager->flush();
    }
}
