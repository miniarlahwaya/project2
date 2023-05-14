<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NomproduitController extends AbstractController
{
    #[Route('/nomproduit', name: 'app_nomproduit')]
    public function index(): Response
    {
        return $this->render('nomproduit/index.html.twig', [
            'controller_name' => 'NomproduitController',
        ]); }






        
}
