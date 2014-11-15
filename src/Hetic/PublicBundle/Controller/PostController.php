<?php

namespace Hetic\PublicBundle\Controller;

use Hetic\PublicBundle\Entity\Post;
use Hetic\PublicBundle\Form\DevisType;
use Hetic\PublicBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{


    /**
     * Get a form
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request){
        $post = new Post();
        $now = new \DateTime('now');
        $post->setDateCreated($now);

        $form = $this->createForm(new PostType(), $post , array(
            'action' => $this->generateUrl('hetic_public_createpost'),
            'method' => 'POST',
            'attr' => array('novalidate' => "novalidate")
        ));

        $form->handleRequest($request);

        if($form->isValid()){

            $this->get('session')->getFlashBag()->add(
                'notice',
                "<b>Success</b> Votre post a bien été crée"
            );

            return $this->redirect($this->generateUrl('twig'));
        }

        return $this->render('HeticPublicBundle:Post:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
