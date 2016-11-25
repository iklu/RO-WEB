<?php

namespace Front\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontAppAdBundle:Default:index.html.twig');
    }
}
