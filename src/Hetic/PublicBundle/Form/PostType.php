<?php

namespace Hetic\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => "Un petit titre", 'attr' => array('class' => 'form-control')))
            ->add('description', null, array('label' => "Une petite description",'attr' => array('class' => 'form-control')))
            ->add('categorie', null, array('label' => "Associer une catégorie"))
            ->add('tag', null, array('label' => "Associer un ou plusieurs tags"))
            ->add('visible', null, array('label' => "Visibe ou pas?"))
            ->add("save", "submit", array(
                "label" => "Sauvegarder ce devis",
                "attr" => array("class" => "btn btn-primary")));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hetic\PublicBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hetic_publicbundle_post';
    }
}
