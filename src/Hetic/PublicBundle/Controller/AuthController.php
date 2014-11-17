<?php

namespace Hetic\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Authentification"
 * Class AuthController
 * @package Hetic\PublicBundle\Controller
 */
class AuthController extends Controller
{

    /**
     * Login Authentification
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('HeticPublicBundle:Auth:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
        ));
    }

    /**
     * Access Forbidden
     * @return Response
     */
    public function forbiddenAction()
    {
        return $this->render('HeticPublicBundle:Auth:forbidden.html.twig');
    }
}
