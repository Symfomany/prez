<?php

namespace Hetic\PublicBundle\Controller;

use Hetic\PublicBundle\Entity\Post;
use Hetic\PublicBundle\Form\Type\PostType;
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
     * CReate a post
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        // Access denied for connexion
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $form = $this->get('hetic_public.post.handler')->getForm();

        if ($this->get('hetic_public.post.handler')->process()) {

            $this->get('session')->getFlashBag()->add(
                'notice',
                $this->get('translator')->trans('post.create')
            );

            return $this->redirect($this->generateUrl('twig'));
        }

        return $this->render('HeticPublicBundle:Post:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * Voir un post
     * @param $id
     * @return Response
     */
    public function voirPostAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('HeticPublicBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'Aucun post trouvé pour cet id : '.$id
            );
        }

        return new Response("<h3>".$post->getTitle()."</h3>");
    }


    /**
     * Update object
     * @param $id
     * @param $title
     * @return RedirectResponse
     */
    public function updatePostAction($id, $title)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('HeticPublicBundle:Post')->find($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'Aucun post trouvé pour cet id : '.$id
            );
        }
        $post->setTitle($title);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b> Votre post a bie été mis a jour"
        );

        return $this->redirect($this->generateUrl('twig'));
    }


    /**
     * Create object
     * @param $title
     * @return RedirectResponse
     */
    public function createPostAction($title)
    {
        $em = $this->getDoctrine()->getManager();
        $post = new Post();
        $post->setTitle($title);
        $em->persist($post);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b> Votre post a bie été crée"
        );

        return $this->redirect($this->generateUrl('twig'));
    }

}
