<?php

namespace backBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dept
 *
 * @ORM\Table(name="dept")
 * @ORM\Entity(repositoryClass="backBundle\Repository\DeptRepository")
 */
class Dept
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
     * @ORM\ManyToOne(targetEntity="Bureau", inversedBy="departements")
     * @ORM\JoinColumn(name="bureau_id", referencedColumnName="id")
     */
    private $bur;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="dept")
     */
    private $collaborateurs;


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
     * @return Dept
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
    public function getCollaborateurs()
    {
        return $this->collaborateurs;
    }

    /**
     * @param mixed $collaborateurs
     */
    public function setCollaborateurs($collaborateurs)
    {
        $this->collaborateurs = $collaborateurs;
    }


    public  function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getNom();
    }


}

