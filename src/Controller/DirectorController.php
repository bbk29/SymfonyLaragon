<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Director;
use App\Form\DirectorType;
use App\Repository\DirectorRepository;

class DirectorController extends AbstractController
{
    /**
     * @Route("/director", name="director")
     */
    public function index(DirectorRepository $repository): Response
    {
        $directors = $repository->findAll();
        return $this->render('director/index.html.twig', [
            'directors' => $directors
        ]);
    }

    /**
     * @Route("/affichedirector/{id}", name="affichedirector")
     */
    public function afficherUnDirecteur(Director $director): Response
    {
        return $this->render('director/afficherUn.html.twig', ['director' => $director]);
    }

    /**
     * @Route("/creationdirector", name="creationdirector")
     * @Route("/modifdirector/{id}", name="modifdirector")
     */
    public function modifDirector(?Director $director, Request $request, EntityManagerInterface $em)
    {
        if(!$director)
        {
        $director = new Director();
        }

        $form = $this->createForm(DirectorType::class, $director);

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
         $em->persist($director);
         $em->flush();
         return $this->redirectToRoute('director');
        }

        return $this->render('director/modifDirector.html.twig',
        [
            'director' => $director,
            'form'=> $form->createView()
        ]);
    }

}
