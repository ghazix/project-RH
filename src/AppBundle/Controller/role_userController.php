<?php

namespace AppBundle\Controller;

use AppBundle\Entity\role_user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Role_user controller.
 *
 * @Route("role_user")
 */
class role_userController extends Controller
{
    /**
     * Lists all role_user entities.
     *
     * @Route("/", name="role_user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $role_users = $em->getRepository('AppBundle:role_user')->findAll();

        return $this->render('role_user/index.html.twig', array(
            'role_users' => $role_users,
        ));
    }

    /**
     * Creates a new role_user entity.
     *
     * @Route("/new", name="role_user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $role_user = new Role_user();
        $form = $this->createForm('AppBundle\Form\role_userType', $role_user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role_user);
            $em->flush();

            return $this->redirectToRoute('role_user_show', array('id' => $role_user->getId()));
        }

        return $this->render('role_user/new.html.twig', array(
            'role_user' => $role_user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a role_user entity.
     *
     * @Route("/{id}", name="role_user_show")
     * @Method("GET")
     */
    public function showAction(role_user $role_user)
    {
        $deleteForm = $this->createDeleteForm($role_user);

        return $this->render('role_user/show.html.twig', array(
            'role_user' => $role_user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing role_user entity.
     *
     * @Route("/{id}/edit", name="role_user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, role_user $role_user)
    {
        $deleteForm = $this->createDeleteForm($role_user);
        $editForm = $this->createForm('AppBundle\Form\role_userType', $role_user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('role_user_edit', array('id' => $role_user->getId()));
        }

        return $this->render('role_user/edit.html.twig', array(
            'role_user' => $role_user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a role_user entity.
     *
     * @Route("/{id}", name="role_user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, role_user $role_user)
    {
        $form = $this->createDeleteForm($role_user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($role_user);
            $em->flush();
        }

        return $this->redirectToRoute('role_user_index');
    }

    /**
     * Creates a form to delete a role_user entity.
     *
     * @param role_user $role_user The role_user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(role_user $role_user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('role_user_delete', array('id' => $role_user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
