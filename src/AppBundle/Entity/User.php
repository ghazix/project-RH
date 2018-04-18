<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="backBundle\Entity\Colls_Clients", mappedBy="clls")
     */
    private $collDoss;

    /**
     *
     * @ORM\ManyToOne(targetEntity="backBundle\Entity\Bureau", inversedBy="collabts")
     * @ORM\JoinColumn(name="bureau_id", referencedColumnName="id")
     */
    private $bur;


    /**
     *
     * @ORM\ManyToOne(targetEntity="backBundle\Entity\Dept", inversedBy="collaborateurs")
     * @ORM\JoinColumn(name="dept_id", referencedColumnName="id")
     */
    private $dept;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEntree", type="datetime", nullable=true )
     */
    private $dateEntree;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSortie", type="datetime", nullable=true)
     */
    private $dateSortie;


    /**
     * @var string
     *
     * @ORM\Column(name="prixH", type="decimal", precision=28, scale=2, nullable=true)
     */
    private $prixH;

    /**
     * @var string
     *
     * @ORM\Column(name="soldeO", type="decimal", precision=28, scale=2, nullable=true)
     */
    private $soldeO;

    /**
     * @var int
     *
     * @ORM\Column(name="moisS", type="integer", nullable=true)
     */
    private $moisS;

    /**
     * @var string
     *
     * @ORM\Column(name="aquis", type="decimal", precision=28, scale=2, nullable=true)
     */
    private $aquis;


    /**
     * @var string
     *
     * @ORM\Column(name="superieur", type="string", length=255, nullable=true)
     */
    private $superieur;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * Many User have One Role.
     * @ORM\ManyToOne(targetEntity="role_user", inversedBy="user")
     * @ORM\JoinColumn(name="role_user_id", referencedColumnName="id")
     */
    private $role_user;


    /**
     * @ORM\ManyToOne(targetEntity="Senior", inversedBy="users")
     * @ORM\JoinColumn(name="senior_id", referencedColumnName="id")
     */
    private $senior;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getCollDoss()
    {
        return $this->collDoss;
    }

    /**
     * @param mixed $collDoss
     */
    public function setCollDoss($collDoss)
    {
        $this->collDoss = $collDoss;
    }

    /**
     * @return mixed
     */
    public function getBur()
    {
        return $this->bur;
    }

    /**
     * @param mixed $bur
     */
    public function setBur($bur)
    {
        $this->bur = $bur;
    }

    /**
     * @return mixed
     */
    public function getDept()
    {
        return $this->dept;
    }

    /**
     * @param mixed $dept
     */
    public function setDept($dept)
    {
        $this->dept = $dept;
    }

    /**
     * @return string
     */
    public function getAquis()
    {
        return $this->aquis;
    }

    /**
     * @param string $aquis
     */
    public function setAquis($aquis)
    {
        $this->aquis = $aquis;
    }

    /**
     * @return \DateTime
     */
    public function getDateEntree()
    {
        return $this->dateEntree;
    }

    /**
     * @param \DateTime $dateEntree
     */
    public function setDateEntree($dateEntree)
    {
        $this->dateEntree = $dateEntree;
    }

    /**
     * @return \DateTime
     */
    public function getDateSortie()
    {
        return $this->dateSortie;
    }

    /**
     * @param \DateTime $dateSortie
     */
    public function setDateSortie($dateSortie)
    {
        $this->dateSortie = $dateSortie;
    }

    /**
     * @return string
     */
    public function getPrixH()
    {
        return $this->prixH;
    }

    /**
     * @param string $prixH
     */
    public function setPrixH($prixH)
    {
        $this->prixH = $prixH;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getMoisS()
    {
        return $this->moisS;
    }

    /**
     * @param int $moisS
     */
    public function setMoisS($moisS)
    {
        $this->moisS = $moisS;
    }

    /**
     * @return string
     */
    public function getSoldeO()
    {
        return $this->soldeO;
    }

    /**
     * @param string $soldeO
     */
    public function setSoldeO($soldeO)
    {
        $this->soldeO = $soldeO;
    }

    /**
     * @return string
     */
    public function getSuperieur()
    {
        return $this->superieur;
    }

    /**
     * @param string $superieur
     */
    public function setSuperieur($superieur)
    {
        $this->superieur = $superieur;
    }

    /**
     * @return mixed
     */
    public function getSenior()
    {
        return $this->senior;
    }

    /**
     * @param mixed $senior
     */
    public function setSenior($senior)
    {
        $this->senior = $senior;
    }


}