<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnneeScolaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $anneScolaire = new AnneeScolaire;
        $anneScolaire->setAnnee('2021-2022');
        $anneScolaire->setEtat('EN COURS');
        $manager->persist($anneScolaire);
        $this->addReference('annee', $anneScolaire);
        $manager->persist($anneScolaire);
        $manager->flush();
    }
}
