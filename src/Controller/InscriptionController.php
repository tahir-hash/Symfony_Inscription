<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use App\Repository\InscriptionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(InscriptionRepository $repo, PaginatorInterface $paginator,
    Request $request): Response
    {
        $insc= new Inscription;
        $data=$repo->findBy(["etat"=>"EN COURS"],['id'=>'DESC']);
        $insc=$paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );
        $cpt=$request->query->getInt('page', 1)*5-4;
        return $this->render('inscription/index.html.twig', [
            'inscriptions'=>$insc,
            'cpt'=>$cpt
        ]);
    }

    #[Route('/add-inscription', name: 'add_inscription')]
    public function add(
    Request $request,
    InscriptionRepository $repo,
    EtudiantRepository $reposit,
    UserPasswordHasherInterface $passwordHasher): Response
    {
            $id=$reposit->findBy([],['id'=>'DESC'])[0]->getId()+1;
            $user = $this->getUser();
            $inscription=new Inscription;
            $etud=new Etudiant;
            $hashedPassword = $passwordHasher->hashPassword(
                $etud,
                "ETUD"
            );
            $etud->setPassword($hashedPassword);
            $etud->setMatricule("MAT--".$id);
            $inscription->setEtudiant($etud);
            $inscription->setAC($user);
            $form = $this->createForm(InscriptionType::class,$inscription);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $name=explode(' ',$inscription->getEtudiant()->getNomComplet());
                $name=strtolower($name[0]);
                $etud->setLogin($name.$id.'@proacedemy.com');
                $repo->add($inscription,true);
                $this->addFlash('success','Inscription reussie');
                return $this->redirectToRoute('app_inscription');
            }
        return $this->render('inscription/create.html.twig', [
            'form'=>$form->createView(),
            'editMode'=>$inscription->getId()!==null,
        ]);
    }

    #[Route('/reinscrire/{id}', name: 'reinscrire')]
    public function reinscrire(
        Request $request,
        InscriptionRepository $repo,
        Inscription $inscription)
        {
               $inscription->setId(null);
                $inscription->setEtat('TERMINER');
                $reinscription=new Inscription;
                $reinscription->setAC($inscription->getAc());
                $reinscription->setEtudiant($inscription->getEtudiant());
                $reinscription->setClasse($inscription->getClasse());
                $form = $this->createForm(InscriptionType::class,$reinscription);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid())
                {
                    $repo->add($reinscription,true);
                    $this->addFlash('success','Reinscription reussie');
                    return $this->redirectToRoute('app_inscription');
                }
            return $this->render('inscription/create.html.twig', [
                'form'=>$form->createView(),
                'editMode'=>$reinscription->getId()==null,
            ]);
        }
}

