<?php

namespace RL\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RLCMSBundle:Default:index.html.twig');
    }
}
