<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\ACRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ACRepository::class)]
class AC extends User
{
    #[ORM\OneToMany(mappedBy: 'AC', targetEntity: Inscription::class)]
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
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
            $inscription->setAC($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getAC() === $this) {
                $inscription->setAC(null);
            }
        }

        return $this;
    }
}
