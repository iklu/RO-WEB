<?php

namespace Front\AppBundle\Controller;

use AppBundle\DataBundle\Model\Cache\Friends;
use Front\CoreBundle\Controller\Front\AbstractFrontController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends AbstractFrontController
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
