<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use App\Repository\InscriptionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{
    #[Route('/own-demande', name: 'app_demande')]
    public function index(
        DemandeRepository $repo,
        InscriptionRepository $reposit,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $demandes = new Demande;
        $inscription = $reposit->findBy(["etat" => "EN COURS", "etudiant" => $this->getUser()->getId()])[0];
        $data = $repo->findBy(["etat" => "EN COURS", "inscription" => $inscription], ['id' => 'DESC']);

        $demandes = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );
        $cpt = $request->query->getInt('page', 1) * 5 - 4;
        $dem = new Demande;
        $dem->setInscription($inscription);
        $form = $this->createForm(DemandeType::class, $dem);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($form->getData(), true);
            return $this->redirectToRoute('app_demande');
        }
        return $this->render('demande/index.html.twig', [
            'demandes' => $demandes,
            'cpt' => $cpt,
            'form' => $form->createView(),
            'etud' => strtoupper($this->getUser()->getNomComplet())
        ]);
    }

    #[Route('demande', name: 'traiter_demande')]
    public function traiterDemande(
        DemandeRepository $repo,
        InscriptionRepository $reposit,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $repo->findBy(["etat" => "EN COURS"], ['id' => 'DESC']);

        $demandes = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );
        $cpt = $request->query->getInt('page', 1) * 5 - 4;
        return $this->render('demande/liste.html.twig', [
            'demandes' => $demandes,
            'cpt' => $cpt,
        ]);
    }

    #[Route('traiter/{id}', name: 'etat_demande')]
    public function traiterDemand(Request $request, Demande $demande, DemandeRepository $repo)
    {
        if ($request->request->get('action') == "valider") {
            $inscription=$demande->getInscription();
            $inscription->setEtat('ANNULER');
            $demande->setLibelle($demande->getLibelle());
            //dd($inscription);
            $user = $this->getUser();
            $demande->setEtat('VALIDER');
            $demande->setRp($user);
            $repo->add($demande, true);
            return  $this->redirectToRoute('traiter_demande');
        }
        if ($request->request->get('action') == "refus") {
            $demande->setLibelle($demande->getLibelle());
            $user = $this->getUser();
            $demande->setEtat('REFUSER');
            $demande->setRp($user);
            $repo->add($demande, true);
            return  $this->redirectToRoute('traiter_demande');
        }
    }
}
