<?php

namespace Hetic\SiteBundle\Controller;

use Hetic\SiteBundle\Entity\Tag;
use Hetic\SiteBundle\Form\TagType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Tag controller.
 *
 */
class TagController extends Controller
{

    /**
     * Lists all tags.
     *
     */
    public function indexAction()
    {
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

            //générer un message flash
            $this->get('session')->getFlashBag()->add(
                'notice',
                "<b>Success</b> Votre formulaire de tag est bien validé. Votre tag a été ajouté en bdd"
            );

            return $this->redirect($this->generateUrl("hetic_site_tag"));
        }



        return $this->render('HeticSiteBundle:Tag:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
