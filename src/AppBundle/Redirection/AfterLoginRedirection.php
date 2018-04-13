<?php
/**
 * @copyright  Copyright (c) 2009-2014 Steven TITREN - www.webaki.com
 * @package    Webaki\UserBundle\Redirection
 * @author     Steven Titren <contact@webaki.com>
 */

namespace AppBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // On récupère la liste des rôles d'un utilisateur
        $roles = $token->getRoles();
        // On transforme le tableau d'instance en tableau simple
        $rolesTab = array_map(function($role){
            return $role->getRole();
        }, $roles);

        // S'il s'agit d'un senior manager (admin) ou d'un super admin on le redirige vers le backoffice
        if (in_array('ROLE_ADMIN', $rolesTab, true) || in_array('ROLE_SUPER_ADMIN', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('seniorManager_page'));
        // sinon, s'il s'agit d'un senior on le redirige vers la page senior
        elseif (in_array('ROLE_SENIOR', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('senior_page'));
        // sinon, s'il s'agit d'un manager on le redirige vers la page manager
        elseif (in_array('ROLE_ MANAGER', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('manager_page'));
        // sinon il s'agit d'un assistant
        else
            $redirection = new RedirectResponse($this->router->generate('assistant_page'));

        return $redirection;
    }
}