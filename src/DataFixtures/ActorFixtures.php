<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actor1 = new Actor();
        $actor1->setPrenom("Tilda")
                ->setNom("Swinton")
                ->setPhoto("https://i.imgur.com/JKkwLDI.jpeg");
        $manager->persist($actor1);

        $actor2 = new Actor();
        $actor2->setPrenom("Cate")
                ->setNom("Blanchett")
                ->setPhoto("https://i.imgur.com/6UNuLjY.jpeg");
        $manager->persist($actor2);

        $manager->flush();
    }
}
