<?php

namespace backBundle\Controller;

use backBundle\Entity\Dept;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Dept controller.
 *
 * @Route("seniorManager/dept")
 */
class DeptController extends Controller
{
    /**
     * Lists all dept entities.
     *
     * @Route("/", name="seniorManager_dept_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $depts = $em->getRepository('backBundle:Dept')->findAll();

        return $this->render('dept/index.html.twig', array(
            'depts' => $depts,
        ));
    }

    /**
     * Creates a new dept entity.
     *
     * @Route("/new", name="seniorManager_dept_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dept = new Dept();
        $form = $this->createForm('backBundle\Form\DeptType', $dept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dept);
            $em->flush();

            return $this->redirectToRoute('seniorManager_dept_show', array('id' => $dept->getId()));
        }

        return $this->render('dept/new.html.twig', array(
            'dept' => $dept,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dept entity.
     *
     * @Route("/{id}", name="seniorManager_dept_show")
     * @Method("GET")
     */
    public function showAction(Dept $dept)
    {
        $deleteForm = $this->createDeleteForm($dept);

        return $this->render('dept/show.html.twig', array(
            'dept' => $dept,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dept entity.
     *
     * @Route("/{id}/edit", name="seniorManager_dept_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dept $dept)
    {
        $deleteForm = $this->createDeleteForm($dept);
        $editForm = $this->createForm('backBundle\Form\DeptType', $dept);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seniorManager_dept_edit', array('id' => $dept->getId()));
        }

        return $this->render('dept/edit.html.twig', array(
            'dept' => $dept,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dept entity.
     *
     * @Route("/{id}", name="seniorManager_dept_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dept $dept)
    {
        $form = $this->createDeleteForm($dept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dept);
            $em->flush();
        }

        return $this->redirectToRoute('seniorManager_dept_index');
    }

    /**
     * Creates a form to delete a dept entity.
     *
     * @param Dept $dept The dept entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dept $dept)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seniorManager_dept_delete', array('id' => $dept->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
