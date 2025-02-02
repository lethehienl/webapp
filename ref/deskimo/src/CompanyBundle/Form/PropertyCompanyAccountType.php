<?php


namespace CompanyBundle\Form;


use AppBundle\Utils\StatusUtil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Utils\RolesUtil;

class PropertyCompanyAccountType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('fullName', TextType::class, array(
        'label' => 'Full name',
        'required' => true,
      ))
      ->add('username', TextType::class, array(
        'label' => 'Email',
        'required' => true,
      ))
      ->add('company', HiddenType::class, array(
        'mapped' => false
      ))
      ->add('roleId', ChoiceType::class, array(
        'label' => 'Role',
        'attr' => array('class' => 'form-control'),
        'label_attr' => array('class' => 'col-md-2 col-form-label'),
        'choices' => array_flip(RolesUtil::CAN_ASSIGN_WHEN_INVATING_COMPANY),
        'choices_as_values' => true
      ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'UserBundle\Entity\User',
    ));
  }
}