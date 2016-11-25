<?php

namespace Front\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontSecurityBundle:Default:index.html.twig');
    }
}
