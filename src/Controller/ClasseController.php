<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $repo, SessionInterface $session): Response
    {
        /* $classes = new Classe;
        $classes ->setLibelle('Licence ig')
                ->setFiliere('Informatique')
                ->setNiveau('L1'); */
       //$repo->add($classes,true);
        $ecole=$repo->findAll();
       // dd($ecole[0]);
       /*  $session->set('user','tahir');
        $this->getUser(); */
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes'=>$ecole
        ]);
    }
}
