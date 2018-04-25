<?php

namespace AppBundle\Controller;

use AppBundle\Entity\acces;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Acce controller.
 *
 * @Route("acces")
 */
class accesController extends Controller
{
    /**
     * Lists all acce entities.
     *
     * @Route("/", name="acces_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $acces = $em->getRepository('AppBundle:acces')->findAll();

        return $this->render('acces/index.html.twig', array(
            'acces' => $acces,
        ));
    }

    /**
     * Creates a new acce entity.
     *
     * @Route("/new", name="acces_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $acce = new Acces();
        $form = $this->createForm('AppBundle\Form\accesType', $acce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acce);
            $em->flush();

            return $this->redirectToRoute('acces_show', array('id' => $acce->getId()));
        }

        return $this->render('acces/new.html.twig', array(
            'acce' => $acce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a acce entity.
     *
     * @Route("/{id}", name="acces_show")
     * @Method("GET")
     */
    public function showAction(acces $acce)
    {
        $deleteForm = $this->createDeleteForm($acce);

        return $this->render('acces/show.html.twig', array(
            'acce' => $acce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing acce entity.
     *
     * @Route("/{id}/edit", name="acces_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, acces $acce)
    {
        $deleteForm = $this->createDeleteForm($acce);
        $editForm = $this->createForm('AppBundle\Form\accesType', $acce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acces_edit', array('id' => $acce->getId()));
        }

        return $this->render('acces/edit.html.twig', array(
            'acce' => $acce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a acce entity.
     *
     * @Route("/{id}", name="acces_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, acces $acce)
    {
        $form = $this->createDeleteForm($acce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acce);
            $em->flush();
        }

        return $this->redirectToRoute('acces_index');
    }

    /**
     * Creates a form to delete a acce entity.
     *
     * @param acces $acce The acce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(acces $acce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('acces_delete', array('id' => $acce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
