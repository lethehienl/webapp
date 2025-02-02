<?php

namespace UserBundle\Form\User;

use ContractBundle\Entity\LicenseKey;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LicenseKeyType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add(
      'keyCode',
      TextType::class,
      [
        'label' => 'Mã khóa học',
        'attr' => ['class' => 'form-control', 'placeholder' => 'Mã khóa học'],
        'label_attr' => ['class' => 'col-md-12 col-form-label control-label'],
        'required' => true
      ]
    )
      ->add(
        'companyCode',
        TextType::class,
        [
          'label' => 'Mã công ty',
          'attr' => ['class' => 'form-control', 'placeholder' => 'Mã công ty',],
          'label_attr' => ['class' => 'col-md-12 col-form-label control-label'],
          'required' => true,
          'mapped' => false
        ]
      )
      ->add(
        'employeeCode',
        TextType::class,
        [
          'label' => 'Mã nhân viên',
          'attr' => ['class' => 'form-control', 'placeholder' => 'Mã nhân viên'],
          'label_attr' => ['class' => 'col-md-12 col-form-label control-label'],
          'required' => true,
          'mapped' => false,
        ]
      );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => LicenseKey::class,
      // enable/disable CSRF protection for this form
      'csrf_protection' => true,
      // the name of the hidden HTML field that stores the token
      'csrf_field_name' => '_token',
      // an arbitrary string used to generate the value of the token
      // using a different string for each form improves its security
      'csrf_token_id' => 'guest_active_invite_code',
    ]);
  }
}