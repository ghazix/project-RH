<?php

namespace backBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BureauGrille
 *
 * @ORM\Table(name="bureau_grille")
 * @ORM\Entity(repositoryClass="backBundle\Repository\BureauGrilleRepository")
 */
class BureauGrille
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
     *
     * @ORM\ManyToOne(targetEntity="backBundle\Entity\Bureau", inversedBy="bureauB")
     * @ORM\JoinColumn(name="bureau_id", referencedColumnName="id")
     */
    private $bureau;

    /**
     *
     * @ORM\ManyToOne(targetEntity="backBundle\Entity\Grille", inversedBy="bureauG")
     * @ORM\JoinColumn(name="grille_id", referencedColumnName="id")
     */
    private $grille;


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
     * @return mixed
     */
    public function getGrille()
    {
        return $this->grille;
    }

    /**
     * @param mixed $grille
     */
    public function setGrille($grille)
    {
        $this->grille = $grille;
    }





}

