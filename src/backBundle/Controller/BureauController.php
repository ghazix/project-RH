<?php

namespace backBundle\Controller;

use backBundle\Entity\Bureau;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Bureau controller.
 *
 * @Route("bureau")
 */
class BureauController extends Controller
{
    /**
     * Lists all bureau entities.
     *
     * @Route("/", name="bureau_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bureaus = $em->getRepository('backBundle:Bureau')->findAll();

        $users = $em->getRepository('AppBundle:User')->findByRole('ROLE_ASSISTANT');

        return $this->render('bureau/index.html.twig', array(
            'bureaus' => $bureaus,
            'users' => $users
        ));
    }

    /**
     * @Route( options={"expose"=true}, name="optionsUpdate")
     * @Method("PUT")
     */
    public function optionsUpdate(Request $request, Bureau $bureau)
    {
        $em=$this->getDoctrine()->getManager();
        $body=$request->getContent();
        $data=json_decode($body,true);
        $entity=$em->getRepository('backBundle:Bureau')->find($data['id']);
        if (!is_object($entity)){
            return new \Symfony\Component\BrowserKit\Response('DATA_NOT_FOUND\', 404');
        }
        $em->persist($entity);
        $em->flush();
    }

    /**
     * Creates a new bureau entity.
     *
     * @Route("/new", name="bureau_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bureau = new Bureau();
        $form = $this->createForm('backBundle\Form\BureauType', $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bureau);
            $em->flush();

            return $this->redirectToRoute('bureau_show', array('id' => $bureau->getId()));
        }

        return $this->render('bureau/new.html.twig', array(
            'bureau' => $bureau,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bureau entity.
     *
     * @Route("/{id}", name="bureau_show")
     * @Method("GET")
     */
    public function showAction(Bureau $bureau)
    {
        $deleteForm = $this->createDeleteForm($bureau);

        return $this->render('bureau/show.html.twig', array(
            'bureau' => $bureau,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bureau entity.
     *
     * @Route("/{id}/edit", name="bureau_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bureau $bureau)
    {
        $deleteForm = $this->createDeleteForm($bureau);
        $editForm = $this->createForm('backBundle\Form\BureauType', $bureau);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bureau_edit', array('id' => $bureau->getId()));
        }

        return $this->render('bureau/edit.html.twig', array(
            'bureau' => $bureau,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bureau entity.
     *
     * @Route("/{id}", name="bureau_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Bureau $bureau)
    {
        $form = $this->createDeleteForm($bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bureau);
            $em->flush();
        }

        return $this->redirectToRoute('bureau_index');
    }

    /**
     * Creates a form to delete a bureau entity.
     *
     * @param Bureau $bureau The bureau entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bureau $bureau)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bureau_delete', array('id' => $bureau->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
