<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfFormType;
use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\Expr\Value;
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
    ): Response
    {
            $prof=new Professeur;
            $form = $this->createForm(ProfFormType::class,$prof);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $repo->add($prof,true);
                return $this->redirectToRoute('app_professeur');
            }
            return $this->render('professeur/create.html.twig', [
                'form'=>$form->createView(),
            ]);
    }
}
