<?php

namespace UserBundle\Form\User;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class UserProfileType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add(
        'phoneNumber',
        TextType::class,
        [
          'label' => 'Phone number',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-md-2 col-form-label control-label'],
          'required' => true
        ]
      );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data-class' => UserProfile::class
    ]);
  }
}