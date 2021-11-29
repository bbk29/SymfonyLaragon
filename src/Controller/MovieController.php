<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name= "movie")
     */
    public function index(MovieRepository $repository): Response
    {
        $movies = $repository->findAll();
        return $this->render('movie/index.html.twig', [
            'movies' => $movies
        ]);
    }

     /**
     * @Route("/affichemovie/{id}", name="affichemovie")
     */
    public function afficherUnMovie(Movie $movie): Response
    {
        return $this->render('movie/afficherUn.html.twig', ['movie' => $movie]);
    }

    /**
     * @Route("/creationmovie", name="creationmovie")
     * @Route("/modifmovie/{id}", name="modifmovie")
     */
    public function modifMovie(?Movie $movie, Request $request, EntityManagerInterface $em)
    {
        if(!$movie)
        {
        $movie = new Movie();
        }

        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
         $em->persist($movie);
         $em->flush();
         return $this->redirectToRoute('movie');
        }

        return $this->render('movie/modifMovie.html.twig',
        [
            'movie' => $movie,
            'form'=> $form->createView()
        ]);
    }
}