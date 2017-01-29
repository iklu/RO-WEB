<?php

namespace Front\SecurityBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 09.01.2017
 * Time: 22:26
 */
class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('password', PasswordType::class)
            ->add('confirmPassword', PasswordType::class)
            ->add('phone', NumberType::class)
            ->add('submit' , SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }

    public function  getName(){
        return "user";
    }
}