<?php

namespace App\DataFixtures;

use App\Entity\AC;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AcFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ac=new AC;
        $ac->setNomComplet('ac');
        $ac->setSexe("Masculin");
        $ac->setLogin('ac@gmail.com');
        $ac->setRoles(['ROLE_AC']);
        $ac->setPassword("ac");
        $manager->persist($ac);
        $this->addReference('ac',$ac); 
        $manager->persist($ac);

        $manager->flush();
    }
}
