<?php

namespace backBundle\Controller;

use backBundle\Entity\Grille;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Grille controller.
 *
 * @Route("seniorManager/grille")
 */
class GrilleController extends Controller
{
    /**
     * Lists all grille entities.
     *
     * @Route("/", name="seniorManager_grille_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grilles = $em->getRepository('backBundle:Grille')->findAll();

        return $this->render('grille/index.html.twig', array(
            'grilles' => $grilles,
        ));
    }

    /**
     * Creates a new grille entity.
     *
     * @Route("/new", name="seniorManager_grille_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $grille = new Grille();
        $form = $this->createForm('backBundle\Form\GrilleType', $grille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grille);
            $em->flush();

            return $this->redirectToRoute('seniorManager_grille_show', array('id' => $grille->getId()));
        }

        return $this->render('grille/new.html.twig', array(
            'grille' => $grille,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a grille entity.
     *
     * @Route("/{id}", name="seniorManager_grille_show")
     * @Method("GET")
     */
    public function showAction(Grille $grille)
    {
        $deleteForm = $this->createDeleteForm($grille);

        return $this->render('grille/show.html.twig', array(
            'grille' => $grille,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing grille entity.
     *
     * @Route("/{id}/edit", name="seniorManager_grille_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Grille $grille)
    {
        $deleteForm = $this->createDeleteForm($grille);
        $editForm = $this->createForm('backBundle\Form\GrilleType', $grille);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seniorManager_grille_edit', array('id' => $grille->getId()));
        }

        return $this->render('grille/edit.html.twig', array(
            'grille' => $grille,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a grille entity.
     *
     * @Route("/{id}", name="seniorManager_grille_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Grille $grille)
    {
        $form = $this->createDeleteForm($grille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grille);
            $em->flush();
        }

        return $this->redirectToRoute('seniorManager_grille_index');
    }

    /**
     * Creates a form to delete a grille entity.
     *
     * @param Grille $grille The grille entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Grille $grille)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seniorManager_grille_delete', array('id' => $grille->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
