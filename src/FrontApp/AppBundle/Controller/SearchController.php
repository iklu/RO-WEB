<?php

namespace FrontApp\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SearchController extends AbstractController
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
