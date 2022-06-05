<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $sexe=['Masculin','Feminin'];
            $etat=['EN COURS','TERMINEE','ANNULEE']; 
            $rand=rand(0,1);
            $rand1=rand(0,2);
            $rand2=rand(0,9);
            $etudiant = new Etudiant;
           /// $rand = rand(0, 2);
            $etudiant->setNomComplet('etud'.$i);
            $etudiant->setSexe($sexe[$rand]);
            $etudiant->setMatricule("Mat".$i);
            $etudiant->setAdresse("Adresse".$i);
            $etudiant->setRoles(['ROLE_ETUDIANT']);
            $etudiant->setLogin('etud'.$i.'@gmail.com');
            $etudiant->setPassword("etud");

            $ins=new Inscription;
            $ins->setEtudiant($etudiant);
            $ins->setEtat($etat[$rand1]);
            $ins->setClasse($this->getReference('classe' .$rand2));
            $ins->setAnneeScolaire($this->getReference('annee'));
            $ins->setAC($this->getReference('ac'));

            
            $manager->persist($ins);
        }

        $manager->flush();
    }
}
