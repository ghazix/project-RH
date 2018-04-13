<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Senior;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("seniorManager/user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="seniorManager_user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="seniorManager_user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userManager = $this->get("fos_user.user_manager");
        $user = $userManager->createUser();

        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);
        $name = $form->getData()->getNom();
        $lastName = $form->getData()->getPrenom();
        $rest = substr($lastName, 0, 1);
        $user->setEnabled(true);
        $user->setPassword("mazars123");
        $user->setUsername($name . $rest);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user);

            if ($this->get('security.token_storage')->getToken()->isGranted('ROLE_SENIOR')) {

                $senior = new Senior();
                $em = $this->getDoctrine()->getManager();
                $senior->setNom($name);
                $senior->setPrenom($lastName);
                $em->flush($senior);
                $em->persist($senior);
            }

            $originalRoles = $this->getParameter('security.role_hierarchy.roles');
            $entityManager = null;
            if ($originalRoles == 'ROLE_ASSISTANT') {
                $senior = new Senior();
                $entityManager->$this->getDoctrine()->getManager();
                $entityManager->persist($senior);
                $entityManager->flush();
            }

            return $this->redirectToRoute('seniorManager_user_show', array('id' => $user->getId()));
        }
        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="seniorManager_user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="seniorManager_user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $userManager = $this->get("fos_user.user_manager");
            $userManager->updateUser($user);
            return $this->redirectToRoute('seniorManager_user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="seniorManager_user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('seniorManager_user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seniorManager_user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }




}
