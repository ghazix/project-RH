<?php

namespace backBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colls_Clients
 *
 * @ORM\Table(name="colls__clients")
 * @ORM\Entity(repositoryClass="backBundle\Repository\Colls_ClientsRepository")
 */
class Colls_Clients
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="collDoss")
     * @ORM\JoinColumn(name="collaborateurs_id", referencedColumnName="id")
     */
    private $clls;

    /**
     *
     * @ORM\ManyToOne(targetEntity="backBundle\Entity\Client", inversedBy="collDossClt")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $clients;



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
    public function getClls()
    {
        return $this->clls;
    }

    /**
     * @param mixed $clls
     */
    public function setClls($clls)
    {
        $this->clls = $clls;
    }

    /**
     * @return mixed
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @param mixed $clients
     */
    public function setClients($clients)
    {
        $this->clients = $clients;
    }


}

