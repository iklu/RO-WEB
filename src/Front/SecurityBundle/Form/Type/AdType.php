<?php

namespace Front\SecurityBundle\Form\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\FormBuilder;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->setAction("/");
        $builder->add('gender', ChoiceType::class, array(
            'choices' => array(
                'm' => 'Male',
                'f' => 'Female'
            ),
            'required'    => false,
            'placeholder' => 'Choose your gender',
            'empty_data'  => null
        ));

        $builder->add('body', TextareaType::class, array(
            'attr' => array('class' => 'tinymce'),
        ));
    }


    public function getName()
    {
        return 'user_ad';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }

    public function getDefaultOptions(array $options)
    {
        $collectionConstraint = new Collection(array(
            'color' => new NotBlank(array('message' => 'Champ vide')),
            'model' => new NotBlank(array('message' => 'Champ vide')),
            'stand' => new NotBlank(array('message' => 'Champ vide')),
            'printer' => new NotBlank(array('message' => 'Champ vide')),
            'cashDrawer' => new NotBlank(array('message' => 'Champ vide')),
            'app' => new NotBlank(array('message' => 'Champ vide')),
        ));

        return array('validation_constraint' => $collectionConstraint);
    }
}