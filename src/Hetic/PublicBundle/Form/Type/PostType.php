<?php

namespace Hetic\PublicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => "post.title.label", 'attr' => array('class' => 'form-control')))
            ->add('description', null, array('label' => "post.description.label", 'attr' => array('class' => 'form-control')))
            ->add('categorie', null, array('label' => "post.categorie.label"))
            ->add('tag', null, array('label' => "post.tag.label"))
            ->add('visible', null, array('label' => "post.visible.label"))
            ->add("save", "submit", array(
                "label" => "post.save",
                "attr" => array("class" => "btn btn-primary"), ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hetic\PublicBundle\Entity\Post',
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
