<?php

namespace UserBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EmployerProfileType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add(
        'username',
        EmailType::class,
        [
          'label' => 'Email',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-form-label control-label'],
          'required' => true
        ]
      )->add(
        'fullName',
        TextType::class,
        [
          'label' => 'Họ và tên',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-form-label control-label'],
          'required' => true
        ]
      )->add(
        'userProfile',
        Profile::class,
        [
          'data_class' => UserProfile::class
        ]
      )->add(
        'oldPassword',
        PasswordType::class,
        [
          'label' => 'Mật khẩu cũ',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-form-label'],
          'required' => false,
          'mapped' => false
        ]
      )->add(
        'password',
        RepeatedType::class,
        [
          'type' => PasswordType::class,
          'first_options' => [
            'label' => 'Mật khẩu mới',
            'label_attr' => ['class' => 'col-form-label']
          ],
          'second_options' => [
            'label' => 'Nhập lại mật khẩu',
            'label_attr' => ['class' => 'col-form-label']
          ],
          'required' => false,
          'options' => ['attr' => ['class' => 'form-control']]
        ]
      );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data-class' => User::class
    ]);
  }
}