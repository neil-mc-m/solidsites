<?php


namespace Solidsites\Forms;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('description', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('info', TextareaType::class,  array(
                'attr' => array(
                    'class' => 'form-control',
                    'id' => 'summernote'
                )
            ))
//            ->add('created_at', TextType::class, array(
//                'attr' => array('class' => 'form-control')
//            ))
//            ->add('updated_at', TextType::class, array(
//                'attr' => array('class' => 'form-control')
//            ))
            ->add('slug', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ));
    }
    public function getName()
    {
        return 'package';
    }

}