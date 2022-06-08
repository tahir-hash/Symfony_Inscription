<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
#[UniqueEntity(fields:'libelle',message: 'le libelle doit etre unique!')]

class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255,unique:true)]
    #[Assert\NotBlank(message: 'le libelle ne doit pas etre vide')]
    private $libelle;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Choisir une filiere')]
    private $filiere;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Choisir un niveau')]
    private $niveau;


    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Inscription::class)]
    private $inscriptions;

    public static $niveaux = [
        '--Choisir un niveau---'=>'',
        "L1" => 'L1', "L2" => 'L2', "L3" => 'L3',
        "M1" => 'M1', "M2" => 'M2', "DOCTORAT" => 'DOCTORAT'
    ];

    public static $filieres = [
        '--Choisir une filiere---'=>'',
        "INFORMATIQUE DE GESTION" => 'INFORMATIQUE DE GESTION',
        "DEV MOBILE" => 'DEV MOBILE', "DEV WEB" => 'DEV WEB',
        "DEV WEB MOBILE" => 'DEV WEB MOBILE',
        "MANAGEMENT" => 'MANAGEMENT',
        "DROIT DES AFFAIRES" => 'DROIT DES AFFAIRES'
    ];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $test;

    #[ORM\ManyToMany(targetEntity: Professeur::class, mappedBy: 'classes')]
    private $professeurs;

    

    public function __construct()
    {
        $this->professeurs = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        $this->professeurs->removeElement($professeur);

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setClasse($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClasse() === $this) {
                $inscription->setClasse(null);
            }
        }

        return $this;
    }

    public function getTest(): ?string
    {
        return $this->test;
    }

    public function setTest(?string $test): self
    {
        $this->test = $test;

        return $this;
    }
}
