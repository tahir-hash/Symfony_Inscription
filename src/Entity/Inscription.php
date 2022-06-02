<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $etat;

    #[ORM\ManyToOne(targetEntity: AC::class, inversedBy: 'inscriptions',cascade:['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $AC;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'inscriptions',cascade:['persist'])]
    private $classe;

    #[ORM\ManyToOne(targetEntity: AnneeScolaire::class, inversedBy: 'inscriptions',cascade:['persist'])]
    private $anneeScolaire;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'inscriptions',cascade:['persist'])]
    private $etudiant;

    #[ORM\OneToMany(mappedBy: 'inscription', targetEntity: Demande::class,cascade:['persist'])]
    private $demandes;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getAC(): ?AC
    {
        return $this->AC;
    }

    public function setAC(?AC $AC): self
    {
        $this->AC = $AC;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getAnneeScolaire(): ?AnneeScolaire
    {
        return $this->anneeScolaire;
    }

    public function setAnneeScolaire(?AnneeScolaire $anneeScolaire): self
    {
        $this->anneeScolaire = $anneeScolaire;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setInscription($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getInscription() === $this) {
                $demande->setInscription(null);
            }
        }

        return $this;
    }
}
