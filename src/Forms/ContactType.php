<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 15/10/2017
 * Time: 23:47
 */

namespace Solidsites\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class);
    }
}