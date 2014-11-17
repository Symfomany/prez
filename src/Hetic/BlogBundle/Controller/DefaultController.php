<?php

namespace Hetic\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HeticBlogBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * Response HETIC
     * @return Response
     */
    public function responseAction(){

        return new Response("<h1>Hello HETIC</h1>");
    }

    /**
     * Redirection vers Response
     * @return RedirectResponse
     */
    public function redirectionAction(){

        return new RedirectResponse($this->generateUrl('hetic_blog_response'));
    }

    /**
     * Foward d'action
     * @return Response
     */
    public function forwardAction(){
        $response = $this->forward('HeticBlogBundle:Default:index', array("name" => "PROMO 2016"));

        return $response;
    }

    /**
     * Not Found Exception
     */
    public function notfoundAction(){

        throw $this->createNotFoundException("La page n'existe plus");
    }

    /**
     * Messages flashs
     * @return RedirectResponse
     */
    public function messagesflashsAction(){
        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b  >Message flash qui ne saffiche qu'une seul fois!"
        );

        return $this->redirect($this->generateUrl("hetic_blog_homepage", array('name' => "Voila :)")));
    }
}
