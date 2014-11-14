<?php

namespace Hetic\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class DevisType
 * @package Hetic\PublicBundle\Form
 */
class DevisType extends AbstractType
{
    /**
     * Build the form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('email', 'email')
            ->add('url', 'url')
            ->add('type', 'choice', array(
                'choices'   => array('1' => 'Devis de construction', '2' => 'Devis de ocation Voiture'),
                'required'  => false,
            ))
            ->add('description',"textarea")
            ->add('budget',"money")
            ->add('budget',"money")
            ->add('save', 'submit');
    }

    public function getName()
    {
        return 'devis';
    }
}