<?php

namespace Front\SecurityBundle\Controller;

use Front\CoreBundle\Controller\Front\AbstractFrontController;
use Front\SecurityBundle\Form\Type\AdType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     * @Route("/register/", name="register")
     */
    public function registerAction(Request $request)
    {
        $form    = $this->createForm("Front\SecurityBundle\Form\Type\RegisterType" , [],
        array(
            'action' => $this->generateUrl('secured_register'),
            'method' => 'POST',
            ));
        $this->params['form'] = $form->createView();
        return $this->render('FrontSecurityBundle:Security:register.html.twig', $this->params);
    }


    /**
     * @Route("/secured/register/", name="secured_register")
     */
    public function securedRegisterAction(Request $request)
    {
        if($request->isMethod('POST')){
            $this->getRegistrationForm()->submit($request);
        }
        return $this->redirectToRoute("login",array(), Response::HTTP_MOVED_PERMANENTLY);
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

        $this->params["body"] = "";
        $body = "";
        try{
            // Create a client with a base URI
            $client = new Client(['base_uri' => $this->getParameter("api")["api_address"]]);
            // Send a request to https://foo.com/api/test
            $response = $client->get("cars/");

            if($response->hasHeader('Content-Length')){
                $body = (string) $response->getBody()->getContents();
            }

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $stringBody =   (string)($e->getResponse()->getBody()->getContents());
                $response = \GuzzleHttp\json_decode($stringBody , true);
            }
        }

        $this->params["body"] = $body;

        return $this->render('FrontSecurityBundle:Security:dashboard.html.twig', $this->params);
    }
}
