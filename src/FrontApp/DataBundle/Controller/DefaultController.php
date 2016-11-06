<?php

namespace FrontApp\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontAppDataBundle:Default:index.html.twig');
    }
}
