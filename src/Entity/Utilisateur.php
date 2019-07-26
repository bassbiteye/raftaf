<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];
    public function  __construct()
    {
        $this->roles = array('ROLE_ADMIN');
    }

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomUtilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomUtilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etatUtilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\partenaire", inversedBy="partenaires")
     */
    private $partenaires;

    public function ____construct()
    {
        $this->partenaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->telephone;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
       
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    public function getEtatUtilisateur(): ?string
    {
        return $this->etatUtilisateur;
    }

    public function setEtatUtilisateur(string $etatUtilisateur): self
    {
        $this->etatUtilisateur = $etatUtilisateur;

        return $this;
    }

    /**
     * @return Collection|Partenaire[]
     */
    public function getPartenaires(): Collection
    {
        return $this->partenaires;
    }

    public function addPartenaire(Partenaire $partenaire): self
    {
        if (!$this->partenaires->contains($partenaire)) {
            $this->partenaires[] = $partenaire;
            $partenaire->setCreatedBy($this);
        }

        return $this;
    }

    public function removePartenaire(Partenaire $partenaire): self
    {
        if ($this->partenaires->contains($partenaire)) {
            $this->partenaires->removeElement($partenaire);
            // set the owning side to null (unless already changed)
            if ($partenaire->getCreatedBy() === $this) {
                $partenaire->setCreatedBy(null);
            }
        }

        return $this;
    }

    public function getPartenaire(): ?partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }
}
