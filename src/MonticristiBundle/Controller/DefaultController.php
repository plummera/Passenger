<?php

namespace MonticristiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function hiNameAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/{page}", name="static")
     * @Template("@MonticristiBundle::default/index.html")
     */
    public function indexAction($page) {
        return array('page' => $page);
    }
}
