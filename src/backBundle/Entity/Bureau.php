<?php

namespace backBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bureau
 *
 * @ORM\Table(name="bureau")
 * @ORM\Entity(repositoryClass="backBundle\Repository\BureauRepository")
 */
class Bureau
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="bur")
     */
    private $collabts;


    /**
     * @ORM\OneToMany(targetEntity="backBundle\Entity\Client", mappedBy="bureau")
     */
    private $client;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity="backBundle\Entity\Dept", mappedBy="bur")
     */
    private $departements;


    /**
     * @ORM\OneToMany(targetEntity="backBundle\Entity\BureauGrille", mappedBy="bureau")
     */
    private $bureauB;


    /**
     * @var string
     *
     * @ORM\Column(name="tarifPaie", type="decimal", precision=5, scale=2)
     */
    private $tarifPaie;

    /**
     * @var string
     *
     * @ORM\Column(name="tarifDucs", type="decimal", precision=5, scale=2)
     */
    private $tarifDucs;

    /**
     * @var string
     *
     * @ORM\Column(name="tarifEntree", type="decimal", precision=5, scale=2)
     */
    private $tarifEntree;

    /**
     * @var string
     *
     * @ORM\Column(name="tarifSortie", type="decimal", precision=5, scale=2)
     */
    private $tarifSortie;

    /**
     * @var string
     *
     * @ORM\Column(name="attestation", type="decimal", precision=5, scale=2)
     */
    private $attestation;


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
    public function getCollabts()
    {
        return $this->collabts;
    }

    /**
     * @param mixed $collabts
     */
    public function setCollabts($collabts)
    {
        $this->collabts = $collabts;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Bureau
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Bureau
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Bureau
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set tarifPaie
     *
     * @param string $tarifPaie
     *
     * @return Bureau
     */
    public function setTarifPaie($tarifPaie)
    {
        $this->tarifPaie = $tarifPaie;

        return $this;
    }

    /**
     * Get tarifPaie
     *
     * @return string
     */
    public function getTarifPaie()
    {
        return $this->tarifPaie;
    }

    /**
     * Set tarifDucs
     *
     * @param string $tarifDucs
     *
     * @return Bureau
     */
    public function setTarifDucs($tarifDucs)
    {
        $this->tarifDucs = $tarifDucs;

        return $this;
    }

    /**
     * Get tarifDucs
     *
     * @return string
     */
    public function getTarifDucs()
    {
        return $this->tarifDucs;
    }

    /**
     * Set tarifEntree
     *
     * @param string $tarifEntree
     *
     * @return Bureau
     */
    public function setTarifEntree($tarifEntree)
    {
        $this->tarifEntree = $tarifEntree;

        return $this;
    }

    /**
     * Get tarifEntree
     *
     * @return string
     */
    public function getTarifEntree()
    {
        return $this->tarifEntree;
    }

    /**
     * Set tarifSortie
     *
     * @param string $tarifSortie
     *
     * @return Bureau
     */
    public function setTarifSortie($tarifSortie)
    {
        $this->tarifSortie = $tarifSortie;

        return $this;
    }

    /**
     * Get tarifSortie
     *
     * @return string
     */
    public function getTarifSortie()
    {
        return $this->tarifSortie;
    }

    /**
     * Set attestation
     *
     * @param string $attestation
     *
     * @return Bureau
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
     * @return mixed
     */
    public function getDepartements()
    {
        return $this->departements;
    }

    /**
     * @param mixed $departements
     */
    public function setDepartements($departements)
    {
        $this->departements = $departements;
    }

    /**
     * @return mixed
     */
    public function getBureauB()
    {
        return $this->bureauB;
    }

    /**
     * @param mixed $bureauB
     */
    public function setBureauB($bureauB)
    {
        $this->bureauB = $bureauB;
    }



    public  function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getNom();
    }


}

