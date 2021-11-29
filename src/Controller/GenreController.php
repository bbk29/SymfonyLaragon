<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre", name="genre")
     */
    public function index(GenreRepository $repository): Response
    {
        $genres = $repository->findAll();
        return $this->render('genre/index.html.twig', [
            'genres' => $genres
        ]);
    }

    /**
     * @Route("/creationgenre", name="creationgenre")
     * @Route("/modifgenre/{id}", name="modifgenre")
     */
    public function modifGenre(?Genre $genre, Request $request, EntityManagerInterface $em)
    {
        if(!$genre)
        {
        $genre = new Genre();
        }

        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
         $em->persist($genre);
         $em->flush();
         return $this->redirectToRoute('genre');
        }

        return $this->render('genre/modifGenre.html.twig',
        [
            'genre' => $genre,
            'form'=> $form->createView()
        ]);
    }
}
