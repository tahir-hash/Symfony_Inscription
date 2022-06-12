<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $repo, PaginatorInterface $paginator,
    Request $request): Response
    {
        $modules=new Module;
        $data=$repo->findBy([],['id'=>'DESC']);
        $modules=$paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );
        $cpt=$request->query->getInt('page', 1)*5-4;
        //ajouter module
        $mod=new Module;
        $form = $this->createForm(ModuleType::class,$mod);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $repo->add($mod,true);
                return $this->redirectToRoute('app_module');
            }
            //finn
        return $this->render('module/index.html.twig', [
            'controller_name' => 'ModuleController',
            'modules'=>$modules,
            'cpt'=>$cpt,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/module/details/{id}', name: 'app_details_module')]
    public function details(ManagerRegistry $manager, Module $module): Response
    {
        $modules=$manager->getRepository(Module::class)->find($module->getId());
        return $this->render('module/details.html.twig', [
            'modules'=>$modules,
        ]);
    }
}
