<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Senior;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
        $roles = $em->getRepository('AppBundle:role_user')->findByEnable(1);
        $seniors = $em->getRepository('AppBundle:User')->findByRole('ROLE_ADMIN');

        return $this->render('user/index.html.twig', array(
            'users' => $users,'roles' => $roles,'seniors' =>$seniors
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
    /**
     * Create a new User entity.
     * @Route("/create", name="user_create")
     * @Method({"GET", "POST"})
     */

    public function userAddAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager();

            $user = new User();

            $user->setEnabled(1);
            // get posted data

            $username =$request->get('username');
            $email =$request->get('email');
            $password= $request->get('password');
            $role = $request->get('role');
            $senior = $request->get('senior');

            if ($password != 'mazars123'){

                $response = json_encode("verifier votre Mot de passe");
                return new Response($response, 500);
            }
            if ($senior){

                $seniorr = $em->getRepository('AppBundle:User')->findOneById($senior);
                        $user->setSenior($seniorr);
            }
            $role_id = $em->getRepository('AppBundle:role_user')->findOneById($role);

            if ($role_id->getType() == 1)  {
                $rolesArr = array('ROLE_ADMIN');
            }
            elseif ($role_id->getType() == 2)  {
                $rolesArr = array('ROLE_SENIOR');
            }
            elseif ($role_id->getType() == 3){
                $rolesArr = array('ROLE_MANAGER');
            }elseif ($role_id->getType() == 4)
                $rolesArr = array('ROLE_ASSISTANT');
            else {
                $rolesArr = array('ROLE_USER');
            }

            $user->setRoles($rolesArr);

            if (!$username) {
                $response = json_encode("username required");

                return new Response($response, 500);
            }elseif (!$email) {
                $response = json_encode("email required");

                return new Response($response, 500);

            }else
                {

                // set center property values
                $user->setNom($nom);
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPlainPassword($password);
                $user->setRoleUser($role_id);
                $em->persist($user);
                $em->flush($user);

                $response = json_encode(array('message'=>'Add user successfully'));
                return new Response($response, 200);
            }

        }
        else{
            $response = json_encode(array('errorMessage' => 'Add usr no valid'));
            return new Response($response, 400);
        }

    }




}
