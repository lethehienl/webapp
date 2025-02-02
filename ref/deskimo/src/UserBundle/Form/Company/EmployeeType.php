<?php

namespace UserBundle\Form\Company;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmployeeType extends AbstractType
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
          'label_attr' => ['class' => 'col-md-2 col-form-label control-label'],
          'required' => true
        ]
      )->add(
        'fullName',
        TextType::class,
        [
          'label' => 'Họ tên',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-md-2 col-form-label control-label'],
          'required' => true
        ]
      )->add(
        'phoneNumber',
        TextType::class,
        [
          'label' => 'Số điện thoại',
          'attr' => ['class' => 'form-control'],
          'label_attr' => ['class' => 'col-md-2 col-form-label'],
          'required' => false
        ]
      );
//       ->add(
//        'status',
//        ChoiceType::class, [
//          'label' => 'Trạng thái',
//          'attr' => ['class' => 'form-control'],
//          'label_attr' => ['class' => 'col-md-2 col-form-label'],
//          'choices' => [
//            'Vô hiệu hoá' => 0,
//            'Kích hoạt' => 1
//          ],
//        ]
//      );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data-class' => User::class
    ]);
  }
}