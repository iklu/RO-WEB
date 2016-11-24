<?php

namespace FrontApp\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends AbstractController
{
    /**
     * @Route("/secured/login_check", name="loginCheck")
     */
    public function loginCheckAction()
    {
        //DO NOT DELETE THIS (Symfony Firewall)
    }

    /**
     * @Route("/secured/logout", name="logout")
     */
    public function logoutAction()
    {
        //DO NOT DELETE THIS (Symfony Firewall)
    }

    /**
     * @Route("/secured/login/" , name="login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('FrontAppAppBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/secured/dashboard/" , name="dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('FrontAppAppBundle:Security:dashboard.html.twig', array(
            // ...
        ));
    }
}
