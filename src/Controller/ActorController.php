<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Actor;
use App\Form\ActorType;
use App\Repository\ActorRepository;

class ActorController extends AbstractController
{
    /**
     * @Route("/actor", name="actor")
     */
    public function index(ActorRepository $repository): Response  //= injection de dépendance
    {
        // $repository = $this->getDoctrine()->getRepository(Actor::class);
        $actors = $repository->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors
        ]);
    }

    /**
     * @Route("/afficheactor/{id}", name="afficheactor")
     */
    // public function afficherUnActeur(ActorRepository $ar, $id): Response  //= injection de dépendance
    public function afficherUnActeur(Actor $actor): Response
    {
        // $repository = $this->getDoctrine()->getRepository(Actor::class);
        // $actor = $ar->find($id);
        return $this->render('actor/afficherUn.html.twig', ['actor' => $actor]);
    }

    /**
     * @Route("/creationactor", name="creationactor")
     * @Route("/modifactor/{id}", name="modifactor")
     */
    public function modifActor(?Actor $actor, Request $request, EntityManagerInterface $em)
    {
        if(!$actor)
        {
        $actor = new Actor();
        }

        $form = $this->createForm(ActorType::class, $actor);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
         $em->persist($actor);
         $em->flush();
         return $this->redirectToRoute('actor');
        }

        return $this->render('actor/modifActor.html.twig',
        [
            'actor' => $actor,
            'form'=> $form->createView()
        ]);
    }
}
