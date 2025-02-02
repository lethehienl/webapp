<?php

namespace UserBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\Company;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CompanyType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $isEdit = @$options['isEdit'];
    $builder
      ->add('name',
        TextType::class,
        [
          'label' => 'Company name',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-md-2 col-form-label control-label'],
          'required' => true
        ]
      )
      ->add('email', EmailType::class,
        [
          'label' => 'admin company',
          'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: admin_company@gmail.com'],
          'label_attr' => ['class' => 'col-md-2 col-form-label control-label'],
          'required' => true
        ]
      );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data-class' => Company::class,
      'isEdit' => false
    ]);
  }
}