<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 15/10/2017
 * Time: 23:47
 */

namespace Solidsites\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('name', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Your name')
            ))
            ->add('email', EmailType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Your email')
            ))
            ->add('package', ChoiceType::class, array(
                'expanded' => true,
                'multiple' => false,
                'choices' => array(
                    'starter package' => 'starter',
                    'editor package' => 'editor',
                    'content specialist package' => 'content'
                ),
                'attr' => array(
                    'class' => 'radio',
//                    'placeholder' => 'Im interested in the ')
                )
            ))
            ->add('message', TextareaType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Type your message here',
                    'rows' => 4,
                    'cols' => 80)
            ));
    }
}