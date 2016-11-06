<?php

namespace FrontApp\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomePageController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('FrontAppAdBundle:Default:index.html.twig', array(
            // ...
        ));
    }

}
