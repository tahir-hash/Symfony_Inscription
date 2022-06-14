<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClassFormType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
   // #[IsGranted('ROLE_RP', message: 'acces refuse')]
    public function index(
        ClasseRepository $repo, SessionInterface $session,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        //$datas=$repo->findAll();
        $data=$repo->findBy([],['id'=>'DESC']);
        $ecole=$paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );

        $cpt=$request->query->getInt('page', 1)*5-4;
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes'=>$ecole,
            'repo'=>$repo,
            'cpt'=>$cpt
        ]);
    }
    #[Route('/add-classe', name: 'app_add_classe')]
    #[Route('/update-classe/{id}', name: 'app_classe_update')]
    public function add(
        Request $request,
       Classe $classe=null,
       ClasseRepository $repo
    ): Response
    {
        if(!$classe)
        {
            $classe=new Classe;
        }
            $form = $this->createForm(ClassFormType::class,$classe);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $repo->add($classe,true);
                $this->addFlash('success','Classe ajoutée avec succès');
                return $this->redirectToRoute('app_classe');
            }
            return $this->render('classe/create.html.twig', [
                'controller_name' => 'ClasseController', 
                'form'=>$form->createView(),
                'editMode'=>$classe->getId()!==null,
            ]);
    }

    #[Route('/delete-classe/{id}', name: 'app_classe_delete')]
    public function delete(
        Classe $classe,
        ManagerRegistry $doctrine
    ): Response
    {
        $en= $doctrine->getManager();
        $en->remove($classe);
        $en->flush();
       // $this->addFlash('success','Delete success');
        return $this->redirectToRoute('app_classe');
    }
}
