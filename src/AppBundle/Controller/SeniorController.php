<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Senior;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Senior controller.
 *
 * @Route("Ssenior")
 */
class SeniorController extends Controller
{
    /**
     * Lists all senior entities.
     *
     * @Route("/", name="Ssenior_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seniors = $em->getRepository('AppBundle:Senior')->findAll();

        return $this->render('senior/index.html.twig', array(
            'seniors' => $seniors,
        ));
    }

    /**
     * Creates a new senior entity.
     *
     * @Route("/new", name="Ssenior_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $senior = new Senior();
        $form = $this->createForm('AppBundle\Form\SeniorType', $senior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($senior);
            $em->flush();

            return $this->redirectToRoute('Ssenior_show', array('id' => $senior->getId()));
        }

        return $this->render('senior/new.html.twig', array(
            'senior' => $senior,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a senior entity.
     *
     * @Route("/{id}", name="Ssenior_show")
     * @Method("GET")
     */
    public function showAction(Senior $senior)
    {
        $deleteForm = $this->createDeleteForm($senior);

        return $this->render('senior/show.html.twig', array(
            'senior' => $senior,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing senior entity.
     *
     * @Route("/{id}/edit", name="Ssenior_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Senior $senior)
    {
        $deleteForm = $this->createDeleteForm($senior);
        $editForm = $this->createForm('AppBundle\Form\SeniorType', $senior);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Ssenior_edit', array('id' => $senior->getId()));
        }

        return $this->render('senior/edit.html.twig', array(
            'senior' => $senior,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a senior entity.
     *
     * @Route("/{id}", name="Ssenior_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Senior $senior)
    {
        $form = $this->createDeleteForm($senior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($senior);
            $em->flush();
        }

        return $this->redirectToRoute('Ssenior_index');
    }

    /**
     * Creates a form to delete a senior entity.
     *
     * @param Senior $senior The senior entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Senior $senior)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Ssenior_delete', array('id' => $senior->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
