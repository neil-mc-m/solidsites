<?php


namespace Solidsites\Forms;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('info', TextareaType::class)
            ->add('created_at', \DateTime::ATOM)
            ->add('Updated_at', \DateTime::ATOM)
            ->add('slug', TextType::class);
    }
    public function getName()
    {
        return 'package';
    }

}