<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie1 = new Movie();
        $movie1->setTitle("Conan Le Barbare")
                ->setDuration("2h09")
                ->setDate(new \DateTime("1982-05-14"))
                ->setDescription("Des milliers d'années avant l’avènement de la civilisation moderne, durant l'âge hyborien...")
                ->setCover("https://is.gd/E0rYXn");
        $manager->persist($movie1);

        $movie2 = new Movie();
        $movie2->setTitle("Le Monde de Narnia 1")
                ->setDuration("2h23")
                ->setDate(new \DateTime("2005-08-12"))
                ->setDescription("Quatre enfants, Peter, Susan, Edmund et Lucy Pevensie sont envoyés dans le manoir du professeur Digory Kirke à la campagne pour fuir Londres et les bombardements pendant la Seconde Guerre mondiale.")
                ->setCover("https://is.gd/iNs4TH");
        $manager->persist($movie2);

        $actor1 = new Actor();
        $actor1->setPrenom("Arnold")
                ->setNom("Schwarzenegger")
                ->setPhoto("https://is.gd/h73Mlu")
                ->addMovie($movie1);
        $manager->persist($actor1);

        $manager->flush();
    }
}