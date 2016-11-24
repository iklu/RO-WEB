<?php

namespace FrontApp\AppBundle\Controller;

use AppBundle\DataBundle\Model\Cache\Friends;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends AbstractController
{
    /**
     * @Route("/" , name="homepage")
     */
    public function indexAction()
    {
        return $this->render('FrontAppAppBundle:Default:index.html.twig', array(
            // ...
        ));
    }

}
