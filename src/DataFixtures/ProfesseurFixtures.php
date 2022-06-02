<?php

namespace App\DataFixtures;

use App\Entity\Module;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $modules=['Php','Js','Java'];
        for ($i = 0; $i < 10; $i++) {
            $sexe=['Masculin','Feminin'] ; 
            $rand=rand(0,1);
            $prof = new Professeur();
            $prof->setNomComplet('prof' . $i);
            $prof->setGrade('grade' . $i);
            $prof->setSexe($sexe[$rand]);
            for ($j = 0; $j < 2; $j++) {
                $ref = rand(0, 9);
                $prof->addClass($this->getReference('classe' . $ref));
            }
            foreach ($modules as $module) {
               $new=new Module;
               $new->setLibelle($module);
               $prof->addModule($new);
            }
            $manager->persist($prof);
        }
        $manager->flush();
    }
}
