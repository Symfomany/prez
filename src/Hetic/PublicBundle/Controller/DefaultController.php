<?php

namespace Hetic\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /** Page index
     * @param $name
     * @return Response
     */
    public function indexAction($name)
    {
        return $this->render('HeticPublicBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * Page message
     * @return Response
     */
    public function messageAction()
    {
        return new Response('<h3>Vous avez un nouveau message</h3>');
    }

    /**Redirection action
     * @return RedirectResponse
     */
    public function redirectionAction()
    {
        return new RedirectResponse($this->generateUrl('hetic_public_forward'));
    }

    /**
     * Forward action
     * @return Response
     */
    public function forwardAction()
    {
        $response = $this->forward('HeticPublicBundle:Default:message', array());
        return $response;
    }

    /**
     * Not Found ACtion
     */
    public function notfoundAction()
    {
        throw $this->createNotFoundException("La page n'existe plus");
    }

    /**
     * Page message flash
     * @return RedirectResponse
     */
    public function messageflashAction()
    {
        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b  >Message flash qui ne saffiche qu'une seul fois!"
        );
        return $this->redirect($this->generateUrl("hetic_public_homepage", array('name' => "Juju")));
    }

    /**
     * Notification ACtion
     * @param string $type
     * @return Response
     */
    public function notificationAction($type = "success")
    {
        return new Response('<h3>Notification: <b>'.ucfirst($type).'</b></h3>');
    }


    /**
     * Page twig
     * @return Response
     */
    public function twigAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('HeticPublicBundle:Post')
            ->getPostsByTitle();

        $message = "Bienvenue au cours HETIC";
        return $this->render('HeticPublicBundle:Default:twig.html.twig', array(
            'message' => $message,
            'posts' => $posts
        ));
    }
}
