<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use App\Form\ProfFormType;
use App\Repository\ClasseRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $repo, PaginatorInterface $paginator,
    Request $request): Response
    {
        $profs= new Professeur;
        $datas=$repo->findAll();
        $data=$repo->findBy([],['id'=>'DESC']);
        $profs=$paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );
        $cpt=$request->query->getInt('page', 1)*5-4;
        //dd($cpt);
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            'profs'=>$profs,
            'cpt'=>$cpt
        ]);
    }

    #[Route('/add-prof', name: 'app_add_prof')]
    public function add(
        Request $request,
       ProfesseurRepository $repo,
       EntityManagerInterface $manager
    ): Response
    {
            $prof=new Professeur;
            $form = $this->createForm(ProfFormType::class,$prof);
             $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $repo->add($form->getData(),true);
                $this->addFlash('success','Enregistrement du professeur reussi');
                return $this->redirectToRoute('app_professeur');
            }
            return $this->render('professeur/create.html.twig', [
                'form'=>$form->createView()
            ]);
    }
}
