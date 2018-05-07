<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('homepage.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/seniorManager/", name="seniorManager_page")
     *
     *
     */
    public function seniorManagerPageAction()
    {
        return $this->render('seniorManager.html.twig');

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/senior/", name="senior_page")
     *
     */
    public function seniorPageAction()
    {

        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('backBundle:Client')->findAll();

        return $this->render('senior.html.twig', array(
            'clients' => $clients,
        ));

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/manager/", name="manager_page")
     *
     */
    public function managerPageAction()
    {

        return $this->render('manager.html.twig');
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/assistant/", name="assistant_page")
     *
     */
    public function assistantPageAction()
    {

        return $this->render('assistant.html.twig');
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/utilisateurs/", name="infosUser_page")
     *
     */
    public function showInfoUserAction()
    {

        return $this->render('loginSuccess.html.twig');
    }



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/feuilleTemps/", name="feuilleTemps")
     *
     */
    public function feuilleTemps()
    {
        return $this->render('feuilleTemps.html.twig');
    }









}
