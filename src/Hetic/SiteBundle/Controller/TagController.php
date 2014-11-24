<?php

namespace Hetic\SiteBundle\Controller;

use Hetic\SiteBundle\Entity\Tag;
use Hetic\SiteBundle\Form\TagType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class TagController
 * @package Hetic\SiteBundle\Controller
 */
class TagController extends Controller
{

    /**
     * Lists all tags.
     *
     */
    public function indexAction()
    {

        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Page interdite");
        }

        //je récupère l'Entité Manager
       $em = $this->getDoctrine()->getManager();

        //je récupère depuis le Manager les tags avec la methode magique findAll()
       $tags = $em->getRepository('HeticSiteBundle:Tag')->findAll();

       return $this->render('HeticSiteBundle:Tag:index.html.twig', array('tags' => $tags));
    }


    /**
     * Vue show de tag
     * @param Tag $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Tag $id){

        return $this->render('HeticSiteBundle:Tag:show.html.twig', array('tag' => $id));

    }


    public function createAction(Request $request){

        //créer un objet tag
        $tag = new Tag();

        //créer un formulaire avec l'obet Tag
        $form = $this->createForm(new TagType(), $tag, array(
            'action' => $this->generateUrl('hetic_site_create'),
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

            $t = $this->get('translator')->trans('form.success');


            //générer un message flash
            $this->get('session')->getFlashBag()->add(
                'notice',
                $t
            );

            return $this->redirect($this->generateUrl("hetic_site_tag"));
        }



        return $this->render('HeticSiteBundle:Tag:create.html.twig', array(
            'form' => $form->createView()
        ));
    }




    public function editAction(Tag $id, Request $request){

        //créer un formulaire avec l'obet Tag
        $form = $this->createForm(new TagType(), $id, array(
            'action' => $this->generateUrl('hetic_site_editer', array('id' => $id->getId())),
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
                "<b>Success</b> Votre tag a été modifié en bdd"
            );

            return $this->redirect($this->generateUrl("hetic_site_tag"));
        }

        return $this->render('HeticSiteBundle:Tag:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function supprimerAction(Tag $id){

        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            "<b>Success</b> Votre tag a été supprimé en bdd"
        );

        return $this->redirect($this->generateUrl("hetic_site_tag"));

    }

}
