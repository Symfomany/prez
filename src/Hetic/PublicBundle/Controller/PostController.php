<?php

namespace Hetic\PublicBundle\Controller;

use Hetic\PublicBundle\Entity\Post;
use Hetic\PublicBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PostController extends Controller
{

    /**
     * List of posts with HTTP Response
     * @return Response
     */
    public function indexAction(Request $request){

        $date = new \Datetime('+1 day');
        $response = new Response();
        $response->setETag($response->getContent());
        $response->setLastModified($date);
        $response->setPublic();
        $response->setExpires($date);

        $response->headers->addCacheControlDirective('must-revalidate', true);

        if ($response->isNotModified($request)) {
            return $response;
        }else{
            $em = $this->getDoctrine()->getManager();
            $posts = $em->getRepository('HeticPublicBundle:Post')->findAll();

            return $this->render(
                'HeticPublicBundle:Post:index.html.twig', array(
                    'posts' => $posts,
                ));
        }
    }


    /**
     * Create a post
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws AccessDeniedExceptionn
     */
    public function createAction(Request $request)
    {
        // Access denied for connexion
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $post = new Post();
        $now = new \DateTime('now');
        $post->setDateCreated($now);

        $form = $this->createForm(new PostType(), $post, array(
            'action' => $this->generateUrl('hetic_public_createpost'),
            'method' => 'POST',
            'attr' => array('novalidate' => "novalidate"),
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {
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
