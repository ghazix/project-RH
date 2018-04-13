<?php

namespace backBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('Default/index.html.twig');
    }


    /**
     * @Route("/pageCalendrier", name="pageCalendrier")
     */
    public function pageCalendrierAction()
    {
        return $this->render('Default/calendrier.html.twig');
    }
    /**
     * @Route("/pageUtilisateurs", name="pageUtilisateurs")
     */
    public function pageUtilisateursAction()
    {
        return $this->render('Default/utilisateurs.html.twig');
    }

}
