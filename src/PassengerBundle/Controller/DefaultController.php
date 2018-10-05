<?php

namespace PassengerBundle\Controller;

use PassengerBundle\Entity\Post;
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
      $ip = $this->getIpAddress();
      $visitorname = $this->getName();

      return array('name' => $name,
                   'ip' => $ip,
                   'visitorname' => $visitorname
                  );
    }

    /**
     * @Route("/", name="static")
     * @Template()
     */
    public function indexAction() {;
        $ip = $this->getIpAddress();

        return array('ip' => $ip);
    }

    public function getIpAddress() {
      // Function to get the client IP address
      $ipaddress = '';
      if (isset($_SERVER['HTTP_CLIENT_IP']))
          $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_X_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_FORWARDED'];
      else if(isset($_SERVER['REMOTE_ADDR']))
          $ipaddress = $_SERVER['REMOTE_ADDR'];
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
        return array('ip' => $ipaddress);
    }

    public function getName() {
      // Try to get the name (not sure but okay)
      $visitorname = '';
      if (isset($_SERVER['LOGNAME']))
        $visitorname = $_SERVER['LOGNAME'];
      else if(isset($_SERVER['USER']))
        $visitorname = $_SERVER['USER'];
      else
        $ipaddress = 'Guest';
      return $visitorname;
        return array('visitorname' => $visitorname);
    }
}
