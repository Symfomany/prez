<?php

namespace Hetic\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

/**
 * Class ContactType
 * @package Hetic\SiteBundle\Form
 */
class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array(
                'label' => 'form.contact.nom',
                "constraints" => array(
                    new NotBlank(array("message" => "form.contact.nom.required")),
                    new Length(array("min" => 3, "minMessage" => "form.contact.nom.min"))),
                'attr' => array(
                        'placeholder' => 'toto',
                        'class' => 'form-control'
                )))
            ->add('email', 'email', array(
                'label' => 'Votre email pro',
                "constraints" => array(
                    new NotBlank(array("message" => "Ce email ne doit pas etre vide")),
                    new Email(array("message" => "Votre email est invalide"))),
                'attr' => array(
                    'placeholder' => 'toto@free.fr',
                    'class' => 'form-control'
                )))

            ->add('sujet', 'choice', array(
                'choices'   => array('1' => 'Demande de contact', '2' => 'Demande de devis', '3' => 'Proposition commerciale'),
                'label' => 'Votre sujet de contact',
                'attr' => array(
                    'class' => 'form-control'
                )))

            ->add('post', 'entity', array(
                'class' => 'HeticSiteBundle:Post',
                'property' => 'title',
                'label' => 'Votre post de choisi',
                'attr' => array(
                    'class' => 'form-control'
                )))


            ->add('url', 'url', array(
                'label' => 'Votre url de site',
                "constraints" => array(
                    new NotBlank(array("message" => "Cette url ne doit pas etre vide")),
                    new Url(array("message" => "Cette url n'est pas valider")),
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'http://'
                )))

            ->add('numero', 'text', array(
                'label' => 'Votre numéro de chambre',
                "constraints" => array(
                    new NotBlank(array("message" => "Cette url ne doit pas etre vide")),
                    new Range(array(
                            'min'        => 1,
                            'max'        => 7,
                            'minMessage' => 'Vous devez faire au moins avoir 1 étage pour entrer',
                            'maxMessage' => 'Vous ne devez pas dépasser 7 étage',
                        ))
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Numéro de chambre'
                )))


            ->add('message', 'textarea', array(
                'label' => 'Votre message',
                'attr' => array(
                    'class' => 'form-control',
                ),
                "constraints" => array(
                    new NotBlank(array("message" => "Ce message ne doit pas etre vide")),
                    new Length(array("min" => 10, "minMessage" => "Votre message est trop court")),
                    new Regex(array(
                        'pattern' => "/^[a-zA-Z0-9,;. ]+$/",
                        'message' => "Votre message n'est pas correcte",
                    )
                ))))

            ->add('submit', 'submit', array('attr' => array('class' => 'btn btn-primary')));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hetic_sitebundle_contact';
    }
}
