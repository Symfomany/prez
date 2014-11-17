<?php

namespace Hetic\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @param $name
     * @return Response
     */
    public function indexAction($name)
    {
        return $this->render('HeticSiteBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * Retourne un message bienvenue
     * @return Response
     */
    public function responseAction(){
        return new Response("<h1>Bienvenue P2016</h1>");
    }

    /**
     * Redirection vers Response
     * @return RedirectResponse
     */
    public function redirectionAction(){
        return new RedirectResponse($this->generateUrl('hetic_site_response'));
    }

    /**
     * Fowarder la Response
     * @return Response
     */
    public function forwardAction(){
        $response = $this->forward('HeticSiteBundle:Default:response');

        return $response;
    }

    /**
     * Not Found Page
     */
    public  function  notfoundAction(){
        throw $this->createNotFoundException("La page n'existe plus");
    }

    /**
     * @return RedirectResponse
     */
    public function messagesflashsAction(){
        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b  >Message flash qui ne saffiche qu'une seul fois!"
        );

        return $this->redirect($this->generateUrl("hetic_site_homepage", array('name' => "Voila :)")));
    }

}
