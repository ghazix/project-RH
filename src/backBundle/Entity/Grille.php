<?php

namespace backBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grille
 *
 * @ORM\Table(name="grille")
 * @ORM\Entity(repositoryClass="backBundle\Repository\GrilleRepository")
 */
class Grille
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
     * @ORM\OneToMany(targetEntity="BureauGrille", mappedBy="grille")
     */
    private $bureauG;


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
     * @ORM\Column(name="tarifAttest", type="decimal", precision=5, scale=2)
     */
    private $tarifAttest;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Grille
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
     * @return mixed
     */
    public function getBureauG()
    {
        return $this->bureauG;
    }

    /**
     * @param mixed $bureauG
     */
    public function setBureauG($bureauG)
    {
        $this->bureauG = $bureauG;
    }



    /**
     * Set tarifPaie
     *
     * @param string $tarifPaie
     *
     * @return Grille
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
     * @return Grille
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
     * @return Grille
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
     * @return Grille
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
     * Set tarifAttest
     *
     * @param string $tarifAttest
     *
     * @return Grille
     */
    public function setTarifAttest($tarifAttest)
    {
        $this->tarifAttest = $tarifAttest;

        return $this;
    }

    /**
     * Get tarifAttest
     *
     * @return string
     */
    public function getTarifAttest()
    {
        return $this->tarifAttest;
    }
}

