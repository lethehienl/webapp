<?php


namespace UserBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;
use UserBundle\Utils\RolesUtil;

class UserType extends AbstractType
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
          'label_attr' => ['class' => 'col-md-2 col-form-label'],
          'required' => true
        ]
      )->add(
        'fullName',
        TextType::class,
        [
          'label' => 'Full name',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-md-2 col-form-label'],
          'required' => true
        ]
      )->add(
        'password',
        RepeatedType::class,
        [
          'type' => PasswordType::class,
          'first_options' => [
            'label' => 'Password',
            'label_attr' => ['class' => 'col-md-2 col-form-label']
          ],
          'second_options' => [
            'label' => 'Repeat Password',
            'label_attr' => ['class' => 'col-md-2 col-form-label']
          ],
          'required' => false,
          'options' => ['attr' => ['class' => 'form-control']]
        ]
      )
      ->add('roleId', ChoiceType::class,
        [
          'label' => 'Role',
          'attr' => array('class' => 'form-control'),
          'label_attr' => array('class' => 'col-md-2 col-form-label'),
          'choices' => array_flip(RolesUtil::CAN_ASSIGN_PERMISSION_ROLE_MAPPING),
          'choices_as_values' => true
        ]
      )
      ->add(
        'status',
        ChoiceType::class, [
          'label' => 'Active',
          'attr' => array('class' => 'form-control'),
          'label_attr' => array('class' => 'col-md-2 col-form-label'),
          'choices' => [
            'No' => 0,
            'Yes' => 1
          ],
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