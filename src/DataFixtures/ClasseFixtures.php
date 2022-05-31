<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {     
        $filières=['Dev Web','Dev Mobile','Dev Web Mobile'] ; 
        $niveaux=['L1','L2','L3'] ; 
        for ($i=0; $i <20 ; $i++) { 
            # code... 
            $classe= New Classe; 
            $rand=rand(0,2); 
            $classe->setFiliere($filières[$rand])
                   ->setNiveau($niveaux[$rand]) 
                   ->setLibelle($niveaux[$rand].' '.$filières[$rand]); 
            $manager->persist($classe); 
            $this->addReference('classe'.$i,$classe); 
        } 
        $manager->flush(); 
    } 
}
