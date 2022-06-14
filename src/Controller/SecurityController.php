<?php

namespace App\Controller;

use App\Repository\AnneeScolaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils,SessionInterface $session,AnneeScolaireRepository $repo): Response
    {
      //  dd($session->get('annee'));
        $annee=$repo->findOneby(['etat'=>"EN COURS"]);
        $session->set('annee',$annee);
        if ($this->getUser()) {
            return $this->redirectToRoute('app_classe');
        }     

       // dd($session->get('annne'));
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(SessionInterface $session): void
    {
        $session->remove('annee');
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
