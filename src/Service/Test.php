<?php

namespace App\Service;

use App\Repository\EtudiantRepository;

class ServiceTest
{
    public function loginEtud($id, string $name)
    {
        $nom=explode(' ',$name);
        $nom=strtolower($nom[0]);
        $login=$nom.$id.'@proacedemy.com';
        return $login;
    }
}
