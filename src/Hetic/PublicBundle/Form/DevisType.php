<?php

namespace Hetic\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\CardScheme;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

/**
 * Class DevisType
 * @package Hetic\PublicBundle\Form
 */
class DevisType extends AbstractType
{
    /**
     * Build the form
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("nom", "text", array(
                "required" => "required",
                "label" => "Votre nom",
                "constraints" => array(
                new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                new Length(array("min" => 3, "minMessage" => "Votre nom est trop petit")),
            ), "attr" => array("class" => "form-control"), ))

            ->add("profession", "text", array(
                "required" => "required",
                "label" => "Votre Profession",
                "constraints" => array(
                new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                new Length(array("min" => 3, "minMessage" => "Votre profession est trop petite")),
            ), "attr" => array("class" => "form-control"), ))

            ->add("email", "email", array(
                "required" => "required",
                "label" => "Votre Email",
                "constraints" => array(
                    new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                    new Email(array("message" => "Ce n'est pas un email")),
                ),
                "attr" => array(
                "class" => "form-control", ), ))

            ->add("adresse", "textarea", array(
                "required" => "required",
                "label" => "Votre Adresse",
                "constraints" => array(
                new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                new Length(array("min" => 3, "minMessage" => "Votre nom est trop petit")),
            ), "attr" => array("class" => "form-control"), ))

            ->add("cp", "text", array(
                "required" => "required",
                "label" => "Votre Code Postal",
                "constraints" => array(
                new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                    new Regex(array(
                        'pattern' => '/^[0-9]{5}$/',
                        'message' => 'Votre cp doit contenir 5 chiffres',
                    )),
            ), "attr" => array("class" => "form-control"), ))

            ->add("ville", "text", array(
                "required" => "required",
                "label" => "Votre Ville",
                "constraints" => array(
                    new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                    new Length(array("min" => 3, "minMessage" => "Votre ville est trop petit")),
                ),
                "attr" => array("class" => "form-control"), ))

            ->add("tel", "number", array(
                "label" => "Votre Téléphone",
                "constraints" => array(
                    new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                    new Regex(array(
                            'pattern' => '/^0[0-9]([ .-]?[0-9]{2}){4}$/',
                            'message' => 'Votre decription doit contenir que des caractères',
                        )),
                ),
                "attr" => array("class" => "form-control"), ))

            ->add("pays", "country", array(
                "label" => "Votre Téléphone",
                "constraints" => array(
                    new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                    new Length(array("min" => 3)),
                ),
                "attr" => array("class" => "form-control"), ))
            ->add("url", "url", array(
                "label" => "Votre Site Web",
                "constraints" => array(
                    new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                    new Url(array("message" => "Cette URL n'est pas valide")),
                ),
                "attr" => array("class" => "form-control"), ))

            ->add("annexe", "choice", array(
                "choices"   => array("Piscine" => "Piscine", "Garage" => "Garage", "Véranda" => "Véranda"),
                "required"  => false,
                "attr" => array("class" => "form-control"),
            ))
            ->add("extras", "choice", array(
                "choices"   => array("Parking" => "Parking", "Climatise" => "Climatise", "Chauffe" => "Chauffe"),
                "required"  => false,
                "attr" => array("class" => "form-control"),
            ))
            ->add("payment", "choice", array(
                "choices"   => array("PTZ" => "PTZ", "10" => "Paiement 10 fois", "CI" => "Crédit Immobilier"),
                "required"  => false,
                "attr" => array("class" => "form-control"),
            ))
            ->add("cb", "text", array(
                "label" => "Votre Numéro de CB VISA",
                "constraints" => array(
                    new CardScheme(array(
                        'schemes' => array(
                            'VISA',
                        ),
                        'message' => "Votre numéro de carte n'est pas valide", )), ),
                "attr" => array("class" => "form-control"), ))
            ->add("type", "choice", array(
                "choices"   => array("1" => "Devis de construction", "2" => "Devis de ocation Voiture"),
                "required"  => false,
                "attr" => array("class" => "form-control"),
            ))
            ->add("nb_pieces", "choice", array(
                "choices"   => array("1" => "PTZ", "2" => "2", "3" => "3", "4" => "4", "5" => "5"),
                "required"  => false,
                "attr" => array("class" => "form-control"),
            ))
            ->add("avant", "checkbox", array(
                "label" => "Mettre en avant ce devis",
                "attr" => array(), ))
            ->add("regions", "choice", array(
                "choices"   => array("1" => "Devis de construction", "2" => "Devis de ocation Voiture"),
                "required"  => false,
                "attr" => array("class" => "form-control"),
            ))
            ->add("villes", "choice", array(
                "choices"   => array("1" => "Paris", "2" => "Marseille", "3" => "Lyon", "4" => "Lille", "5" => "Bordeaux"),
                "required"  => false,
                "attr" => array("class" => "form-control"),
            ))
            ->add("parking", "checkbox", array("attr" => array()))
            ->add("description", "textarea", array(
                "label" => "Description du projet",
                "attr" => array(
                    "class" => "form-control", ),
                "constraints" => array(
                    new NotBlank(array("message" => "Ce champs ne doit pas etre vide")),
                    new Length(array("min" => 10)),
                    new Regex(array(
                        'pattern' => '/^\w+/',
                        'message' => 'Votre decription doit contenir que des caractères',
                    )
                ), ), ))
            ->add("type", "textarea", array(
                "label" => "Type du projet",
                "attr" => array("class" => "form-control"), ))
            ->add("budget_min", "money", array(
                "label" => "Budget Minimum",
                "attr" => array("class" => "form-control"), ))
            ->add("budget_max", "money", array(
                "label" => "Budget Maximum",
                "attr" => array("class" => "form-control"), ))
            ->add("superficie_min", "money", array(
                "label" => "Superficie Minmum",
                "attr" => array("class" => "form-control"), ))
            ->add("superficie_max", "money", array(
                "label" => "Superficie Maximum",
                "attr" => array("class" => "form-control"), ))
            ->add("cgu", "checkbox", array(
                "label" => "J'accèpte les conditions générales d'utilisation",
                "mapped" => false,
            ))
            ->add("save", "submit", array(
                "label" => "Sauvegarder ce devis",
                "attr" => array("class" => "btn btn-primary"), ));
    }

    public function getName()
    {
        return "devis";
    }
}
