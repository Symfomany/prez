<?php

namespace Hetic\BlogBundle\Controller;

use Hetic\BlogBundle\Entity\Tag;
use Hetic\BlogBundle\Form\TagType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


/**
 * Tag controller.
 *
 */
class TagController extends Controller
{

    /**
     * Lists all tag entities.
     *
     */
    public function indexAction()
    {

        //récupérer l'entité manager
        $em = $this->getDoctrine()->getManager();

        //il utilise l'entité manager pour récupérer ma liste de tag avec findAll
        $tags = $em->getRepository('HeticBlogBundle:Tag')->findAll();

        //j'envoie ma liste de tags à la vue
        return $this->render('HeticBlogBundle:Tag:index.html.twig', array('tags' => $tags));
    }

    /**
     * Retour un seul tag
     * @param Tag $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Tag $id)
    {

        return $this->render('HeticBlogBundle:Tag:show.html.twig', array('tag' => $id));
    }


    public function editAction( Request $request, Tag $id){

        //Ceéer un formulaire de TAG lié  mon objet Tag
        $form = $this->createForm(new TagType(), $id, array(
            'action' => $this->generateUrl('hetic_blog_tag_edit', array('id' => $id->getId() )),
            'method' => 'POST',
            'attr' => array('novalidate' => "novalidate"),
        ));

        //formulaire est lié à la requete
        $form->handleRequest($request);

        //validation de mon formulaire
        if ($form->isValid()) {

            //récupérer l'entité manager
            $em = $this->getDoctrine()->getManager();

            //enregistre mon tag
            $em->persist($id);
            $em->flush();

            //générer un message flash
            $this->get('session')->getFlashBag()->add(
                'notice',
                "<b>Success</b> Votre formulaire de tag est bien validé. Votre tag a été modifié en bdd"
            );

            return $this->redirect($this->generateUrl("hetic_blog_homepage", array('name' => "Enfin :)")));
        }


        return $this->render('HeticBlogBundle:Tag:edit.html.twig', array(
            'form' => $form->createView(),
            'tag' => $id
        ));

    }


    public function createAction(Request $request)
    {

//        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
//            throw new AccessDeniedException();
//        }


        //créer un objet TAG
        $tag = new Tag();

        //Ceéer un formulaire de TAG lié  mon objet Tag
        $form = $this->createForm(new TagType(), $tag, array(
            'action' => $this->generateUrl('hetic_blog_tag_create'),
            'method' => 'POST',
            'attr' => array('novalidate' => "novalidate"),
        ));

        //formulaire est lié à la requete
        $form->handleRequest($request);

        //validation de mon formulaire
        if ($form->isValid()) {

            //récupérer l'entité manager
            $em = $this->getDoctrine()->getManager();

            //enregistre mon tag
            $em->persist($tag);
            $em->flush();

            //générer un message flash
            $this->get('session')->getFlashBag()->add(
                'notice',
                "<b>Success</b> Votre formulaire de tag est bien validé. Votre tag a été ajouté en bdd"
            );

            return $this->redirect($this->generateUrl("hetic_blog_homepage", array('name' => "Voila :)")));
        }


        return $this->render('HeticBlogBundle:Tag:create.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function removeAction(Tag $id){

        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();

        //générer un message flash
        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b> Votre tag a été supprimé en bdd"
        );

        return $this->redirect($this->generateUrl("hetic_blog_homepage", array('name' => "Voila :)")));

    }





}
