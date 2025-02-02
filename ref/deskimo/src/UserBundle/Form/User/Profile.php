<?php

namespace UserBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Profile extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('employeeCode',
        TextType::class,
        array(
          'label' => 'Mã nhân viên',
          'attr' => array(
            'class' => 'col-md-12 form-control',
          ),
          'label_attr' => array('class' => 'col-form-label'),
          'required' => false
        )
      );
  }
}