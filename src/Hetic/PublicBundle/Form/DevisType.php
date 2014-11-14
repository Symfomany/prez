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
            ->add('nom', 'text', array('attr' => array('class' => "form-control")))
            ->add('profession', 'text', array('attr' => array('class' => "form-control")))
            ->add('email', 'email', array('attr' => array('class' => "form-control")))
            ->add('adresse', 'textarea', array('attr' => array('class' => "form-control")))
            ->add('cp', 'text', array('attr' => array('class' => "form-control")))
            ->add('ville', 'text', array('attr' => array('class' => "form-control")))
            ->add('tel', 'number', array('attr' => array('class' => "form-control")))
            ->add('pays', 'country', array('attr' => array('class' => "form-control")))
            ->add('url', 'url', array('attr' => array('class' => "form-control")))
            ->add('annexe', 'choice', array(
                'choices'   => array('Piscine' => 'Piscine', 'Garage' => 'Garage', 'Véranda' => "V

                éranda"),
                'required'  => false,
                'attr' => array('class' => "form-control")
            ))
            ->add('type', 'choice', array(
                'choices'   => array('1' => 'Devis de construction', '2' => 'Devis de ocation Voiture'),
                'required'  => false,
                'attr' => array('class' => "form-control")
            ))
            ->add('nb_pieces', 'choice', array(
                'choices'   => array('1' => 'PTZ', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
                'required'  => false,
                'attr' => array('class' => "form-control")
            ))
            ->add('avant', 'checkbox', array('attr' => array('class' => "form-control")))
            ->add('regions','choice', array(
                'choices'   => array('1' => 'Devis de construction', '2' => 'Devis de ocation Voiture'),
                'required'  => false,
                'attr' => array('class' => "form-control")
            ))
            ->add('villes','choice', array(
                'choices'   => array('1' => 'Paris', '2' => 'Marseille', '3' => 'Lyon', '4' => 'Lille', '5' => 'Bordeaux'),
                'required'  => false,
                'attr' => array('class' => "form-control")
            ))
            ->add('parking', 'checkbox', array('attr' => array('class' => "form-control")))
            ->add('description',"textarea", array('attr' => array('class' => "form-control")))
            ->add('type',"textarea", array('attr' => array('class' => "form-control")))
            ->add('budget_min',"money", array('attr' => array('class' => "form-control")))
            ->add('budget_max',"money", array('attr' => array('class' => "form-control")))
            ->add('superficie_min',"money", array('attr' => array('class' => "form-control")))
            ->add('superficie_max',"money", array('attr' => array('class' => "form-control")))
            ->add('save', 'submit', array('attr' => array('class' => "form-control")));
    }

    public function getName()
    {
        return 'devis';
    }
}