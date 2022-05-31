<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $repo,): Response
    {
        $profs= new Professeur;
        $profs=$repo->findAll();
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            'profs'=>$profs
        ]);
    }
}
