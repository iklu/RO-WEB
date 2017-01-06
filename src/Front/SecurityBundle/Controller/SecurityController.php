<?php

namespace Front\SecurityBundle\Controller;

use Front\CoreBundle\Controller\Front\AbstractFrontController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends AbstractFrontController
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

        return $this->render('FrontSecurityBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/secured/dashboard/" , name="dashboard")
     */
    public function dashboardAction()
    {
        

    //    var_dump($this->getAuthenticatedClient()) ;

        return $this->render('FrontSecurityBundle:Security:dashboard.html.twig', array(
            // ...
        ));
    }
}
