<?php

namespace Front\CoreBundle\Controller;

use Front\CoreBundle\Helper\Request\RequestHelperInterface;
use Front\CoreBundle\Helper\Security\SecurityHelperInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AbstractController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontCoreBundle:Default:index.html.twig');
    }

    public function getRequestHelper() : RequestHelperInterface
    {
        return $this->get('request.helper');
    }

    public function getSecurityHelper() : SecurityHelperInterface
    {
        return $this->get('security.helper');
    }
}
