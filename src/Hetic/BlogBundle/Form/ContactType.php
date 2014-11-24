<?php

namespace Hetic\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                "constraints" => array(
                    new NotBlank(array("message" => "Ce nom ne doit pas etre vide")),
                    new Length(array("min" => 3, "minMessage" => "Votre nom est trop petit")),
                    new Regex(
                        array(
                        'pattern' => "/^[a-zA-Z- ]+$/",
                        'message' => "Votre nom n'est pas correcte",)
                    )),

                'label' => 'contact.nom.label','attr' => array('placeholder' => "Toto",'class' => 'form-control')))

            ->add('email', 'email', array(
                "constraints" => array(
                    new NotBlank(array("message" => "Ce email ne doit pas etre vide")),
                    new Email(array("message" => "Votre email est invalide"))),

                'label' => 'Votre email','attr' => array('placeholder' => "toto@free.fr",'class' => 'form-control')))

            ->add('url', 'url', array(
                "constraints" => array(
                    new NotBlank(array("message" => "Ce url ne doit pas etre vide")),
                    new Url(array("message" => "Votre url est invalide"))),

                'label' => 'Votre url','attr' => array('placeholder' => "http://",'class' => 'form-control')))

            ->add('sujet', 'choice', array(
                'choices'   => array('1' => 'Demande de contact', '2' => 'Demande de devis', '3' => 'Proposition commerciale'),
                'label' => 'Votre sujet de contact',
                'attr' => array(
                    'class' => 'form-control'
                )))

            ->add('post', 'entity', array(
                'class' => 'HeticBlogBundle:Tag',
                'property' => 'word',
                'label' => 'Votre post de choisi',
                'attr' => array(
                    'class' => 'form-control'
                )))

            ->add('numero', 'text', array(
                'label' => 'Votre numéro de chambre',
                "constraints" => array(
                    new NotBlank(array("message" => "Ce numéro ne doit pas etre vide")),
                    new Range(array(
                        'min'        => 1,
                        'max'        => 7,
                        'minMessage' => 'Vous devez faire au moins avoir 1 num de chambre pour entrer',
                        'maxMessage' => 'Vous ne devez pas dépasser 7 numéro de chambre',
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
                    'cols' => 60,
                    'rows' => 5
                ),
                "constraints" => array(
                    new NotBlank(array("message" => "Ce message ne doit pas etre vide")),
                    new Length(array("min" => 10, "minMessage" => "Votre message est trop court")),
                    new Regex(array(
                            'pattern' => "/^[a-zA-Z0-9,;. ]+$/",
                            'message' => "Votre message n'est pas correcte",
                        )
                    ))))


        ;
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
        return 'hetic_blogbundle_contact';
    }
}
