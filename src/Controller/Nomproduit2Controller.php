<?php

namespace App\Controller;

use App\Entity\Nomproduit;
use App\Form\NomproduitType;
use App\Repository\NomproduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/nomproduit2')]
class Nomproduit2Controller extends AbstractController
{
    #[Route('/', name: 'app_nomproduit2_index', methods: ['GET'])]
    public function index(NomproduitRepository $nomproduitRepository): Response
    {
        return $this->render('nomproduit2/index.html.twig', [
            'nomproduits' => $nomproduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nomproduit2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NomproduitRepository $nomproduitRepository): Response
    {
        $nomproduit = new Nomproduit();
        $form = $this->createForm(NomproduitType::class, $nomproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomproduitRepository->save($nomproduit, true);

            return $this->redirectToRoute('app_nomproduit2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nomproduit2/new.html.twig', [
            'nomproduit' => $nomproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nomproduit2_show', methods: ['GET'])]
    public function show(Nomproduit $nomproduit): Response
    {
        return $this->render('nomproduit2/show.html.twig', [
            'nomproduit' => $nomproduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nomproduit2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nomproduit $nomproduit, NomproduitRepository $nomproduitRepository): Response
    {
        $form = $this->createForm(NomproduitType::class, $nomproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomproduitRepository->save($nomproduit, true);

            return $this->redirectToRoute('app_nomproduit2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nomproduit2/edit.html.twig', [
            'nomproduit' => $nomproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nomproduit2_delete', methods: ['POST'])]
    public function delete(Request $request, Nomproduit $nomproduit, NomproduitRepository $nomproduitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nomproduit->getId(), $request->request->get('_token'))) {
            $nomproduitRepository->remove($nomproduit, true);
        }

        return $this->redirectToRoute('app_nomproduit2_index', [], Response::HTTP_SEE_OTHER);
    }
}
