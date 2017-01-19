<?php

namespace Front\CoreBundle\Controller\Front;
use Front\CoreBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 06.01.2017
 * Time: 15:17
 */
abstract class AbstractFrontController extends AbstractController implements FrontControllerInterface
{

    public $params = array();

    protected function getAuthenticatedClient()
    {
        return $this->getSecurityHelper()->getAuthenticatedClient();
    }

    protected function getRegistrationForm(){
        return $this->get("registration.form");
    }
    
    
}