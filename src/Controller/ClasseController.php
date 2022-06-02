<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClassFormType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(
        ClasseRepository $repo, SessionInterface $session,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data=$repo->findAll();
        $ecole=$paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes'=>$ecole
        ]);
    }

    #[Route('/add-classe', name: 'app_add_classe')]
    public function add(
        Request $request,
       EntityManagerInterface $manager
    ): Response
    {
            $classe=new Classe;
            $form = $this->createForm(ClassFormType::class,$classe);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $manager->persist($classe);
                $manager->flush();
                return $this->redirectToRoute('app_classe');
            }
            return $this->render('classe/create.html.twig', [
                'controller_name' => 'ClasseController', 
                'form'=>$form->createView()
            ]);
    }
}
