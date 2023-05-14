<?php

namespace App\Controller;

use App\Entity\Personnes;
use App\Form\PersonnesType;
use App\Repository\PersonnesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnesController extends AbstractController
{
    #[Route('/personnes', name: 'app_personnes')]
    public function index(): Response
    {
        return $this->render('personnes/index.html.twig', [
            'controller_name' => 'PersonnesController',
        ]);
  
  }



  #[Route('/add', name: 'app_personnes_new', methods: ['GET', 'POST'])]
  public function new(Request $request, PersonnesRepository $PersonnesRepository): Response
  {
      $personne = new Personnes();
      $form = $this->createForm(PersonnesType::class, $personne);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $PersonnesRepository->save($personne, true);
          

          return $this->redirectToRoute('app_personnes_new', [], Response::HTTP_SEE_OTHER);
      }

      return $this->renderForm('personnes/new.html.twig', [
          'personne' => $personne,
          'form' => $form,
      ]);
  }













}
