<?php

namespace Hetic\PublicBundle\Controller;

use Hetic\PublicBundle\Form\Type\DevisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /** Page index
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('HeticPublicBundle:Default:index.html.twig', array(
            'name' => "Boyer Julien",
        ));
    }

    /**
     * Get a form
     * @param  Request  $request
     * @return Response
     */
    public function formAction(Request $request)
    {
        $form = $this->createForm(new DevisType(), null, array(
            'action' => $this->generateUrl('hetic_public_form'),
            'method' => 'POST',
            'attr' => array('novalidate' => "novalidate"),
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('session')->getFlashBag()->add(
                'notice',
                "<b>Success</b> Votre formulaire de devis a bien été envoyé"
            );

            return $this->redirect($this->generateUrl('twig'));
        }

        return $this->render('HeticPublicBundle:Default:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Page message
     * @return Response
     */
    public function messageAction()
    {
        $name = "Julien";
        $t = $this->get('translator')->trans('Vous avez un nouveau message %name%', array('%name%' => $name ));

        return new Response($t);
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
     * @param  string   $type
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
            'posts' => $posts,
        ));
    }
}
