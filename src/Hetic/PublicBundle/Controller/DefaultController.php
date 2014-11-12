<?php

namespace Hetic\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('HeticPublicBundle:Default:index.html.twig', array('name' => $name));
    }

    public function messageAction()
    {
        return new Response('<h3>Vous avez un nouveau message</h3>');
    }

    public function redirectionAction()
    {
        return new RedirectResponse($this->generateUrl('dashboard'));
    }

    public function forwardAction()
    {
        $response = $this->forward('AcmeDemoBundle:Demo:contact', array());
        return $response;
    }

    public function notfoundAction()
    {
        throw $this->createNotFoundException("La page n'existe plus");
    }

    public function messageflashAction()
    {
        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b  >Message flash qui ne saffiche qu'une seul fois!"
        );
        return $this->redirect($this->generateUrl("dashboard"));
    }

    public function notificationAction($type = "success")
    {
        return new Response('<h3>Notification: <b>'.ucfirst($type).'</b></h3>');
    }

    public function twigAction()
    {
        $message = "Bienvenue au cours HETIC";
        return $this->render('HeticPublicBundle:Default:twig.html.twig', array(
            'message' => $message
        ));
    }
}
