<?php

namespace PassengerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function nameAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/{page}", name="static")
     * @Template("@PassengerBundle::default/index.html")
     */
    public function indexAction($page) {
        return array('page' => $page);
    }
}
