<?php

namespace Hetic\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Hetic\SiteBundle\Entity\Categorie;
use Hetic\SiteBundle\Form\CategorieType;

/**
 * Categorie controller.
 *
 */
class CategorieController extends Controller
{

    /**
     * Lists all Categorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HeticSiteBundle:Categorie')->findAll();

        return $this->render('HeticSiteBundle:Categorie:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Categorie entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Categorie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hetic_site_categorie_show', array('id' => $entity->getId())));
        }

        return $this->render('HeticSiteBundle:Categorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Categorie entity.
     *
     * @param Categorie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Categorie $entity)
    {
        $form = $this->createForm(new CategorieType(), $entity, array(
            'action' => $this->generateUrl('hetic_site_categorie_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Categorie entity.
     *
     */
    public function newAction()
    {
        $entity = new Categorie();
        $form   = $this->createCreateForm($entity);

        return $this->render('HeticSiteBundle:Categorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categorie entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HeticSiteBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HeticSiteBundle:Categorie:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categorie entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HeticSiteBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HeticSiteBundle:Categorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Categorie entity.
    *
    * @param Categorie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Categorie $entity)
    {
        $form = $this->createForm(new CategorieType(), $entity, array(
            'action' => $this->generateUrl('hetic_site_categorie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Categorie entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HeticSiteBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('hetic_site_categorie_edit', array('id' => $id)));
        }

        return $this->render('HeticSiteBundle:Categorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Categorie entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HeticSiteBundle:Categorie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categorie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('hetic_site_categorie'));
    }

    /**
     * Creates a form to delete a Categorie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hetic_site_categorie_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
