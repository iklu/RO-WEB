<?php

namespace Front\AppBundle\Controller;

use Front\CoreBundle\Controller\Front\AbstractFrontController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SearchController extends AbstractFrontController
{
    /**
     * @Route("/search/", name="search")
     */
    public function indexAction()
    {
        $this->params["search"] = "search";
        return $this->render('FrontAppAppBundle:Search:index.html.twig', $this->params);
    }

}
