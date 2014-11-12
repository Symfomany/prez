<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{

    public function indexAction()
    {
        return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
    }

    public function dashboardAction()
    {
        return $this->render('AcmeDemoBundle:Welcome:dashboard.html.twig');
    }
}
