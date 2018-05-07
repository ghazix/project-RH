<?php

namespace backBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="backBundle\Repository\ClientRepository")
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @ORM\OneToMany(targetEntity="backBundle\Entity\Colls_Clients", mappedBy="clients")
     */
    private $collDossClt;


    /**
     *
     * @ORM\ManyToOne(targetEntity="backBundle\Entity\Bureau", inversedBy="client")
     * @ORM\JoinColumn(name="bureau_id", referencedColumnName="id")
     */
    private $bureau;


    /**
     * @var string
     *
     * @ORM\Column(name="puPaie", type="decimal", precision=28, scale=2)
     */
    private $puPaie;

    /**
     * @var string
     *
     * @ORM\Column(name="remise", type="decimal", precision=38, scale=2)
     */
    private $remise;

    /**
     * @var string
     *
     * @ORM\Column(name="entree", type="decimal", precision=38, scale=2)
     */
    private $entree;

    /**
     * @var string
     *
     * @ORM\Column(name="sortie", type="decimal", precision=38, scale=2)
     */
    private $sortie;

    /**
     * @var string
     *
     * @ORM\Column(name="attestation", type="decimal", precision=38, scale=2)
     */
    private $attestation;

    /**
     * @var string
     *
     * @ORM\Column(name="ducs", type="decimal", precision=38, scale=2)
     */
    private $ducs;

    /**
     * @var string
     *
     * @ORM\Column(name="ducsT", type="decimal", precision=38, scale=2)
     */
    private $ducsT;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getCollDossClt()
    {
        return $this->collDossClt;
    }

    /**
     * @param mixed $collDossClt
     */
    public function setCollDossClt($collDossClt)
    {
        $this->collDossClt = $collDossClt;
    }

    /**
     * @return mixed
     */
    public function getBureau()
    {
        return $this->bureau;
    }

    /**
     * @param mixed $bureau
     */
    public function setBureau($bureau)
    {
        $this->bureau = $bureau;
    }

    /**
     * Set puPaie
     *
     * @param string $puPaie
     *
     * @return Client
     */
    public function setPuPaie($puPaie)
    {
        $this->puPaie = $puPaie;

        return $this;
    }

    /**
     * Get puPaie
     *
     * @return string
     */
    public function getPuPaie()
    {
        return $this->puPaie;
    }

    /**
     * Set remise
     *
     * @param string $remise
     *
     * @return Client
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return string
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set entree
     *
     * @param string $entree
     *
     * @return Client
     */
    public function setEntree($entree)
    {
        $this->entree = $entree;

        return $this;
    }

    /**
     * Get entree
     *
     * @return string
     */
    public function getEntree()
    {
        return $this->entree;
    }

    /**
     * Set sortie
     *
     * @param string $sortie
     *
     * @return Client
     */
    public function setSortie($sortie)
    {
        $this->sortie = $sortie;

        return $this;
    }

    /**
     * Get sortie
     *
     * @return string
     */
    public function getSortie()
    {
        return $this->sortie;
    }

    /**
     * Set attestation
     *
     * @param string $attestation
     *
     * @return Client
     */
    public function setAttestation($attestation)
    {
        $this->attestation = $attestation;

        return $this;
    }

    /**
     * Get attestation
     *
     * @return string
     */
    public function getAttestation()
    {
        return $this->attestation;
    }

    /**
     * Set ducs
     *
     * @param string $ducs
     *
     * @return Client
     */
    public function setDucs($ducs)
    {
        $this->ducs = $ducs;

        return $this;
    }

    /**
     * Get ducs
     *
     * @return string
     */
    public function getDucs()
    {
        return $this->ducs;
    }

    /**
     * Set ducsT
     *
     * @param string $ducsT
     *
     * @return Client
     */
    public function setDucsT($ducsT)
    {
        $this->ducsT = $ducsT;

        return $this;
    }

    /**
     * Get ducsT
     *
     * @return string
     */
    public function getDucsT()
    {
        return $this->ducsT;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Client
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    public function __toString()
    {
        return $this->nom;
        // TODO: Implement __toString() method.
    }


}

