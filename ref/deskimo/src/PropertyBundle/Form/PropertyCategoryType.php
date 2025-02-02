<?php

namespace PropertyBundle\Form;

use AclBundle\Entity\RolePermissions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyCategoryType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, array(
        'label' => 'Name',
        'required' => true,
      ))
      ->add('description', TextareaType::class, array('required' => false,
        'attr' => array('maxlength' => 255)
      ));
    // $builder->add('save', SubmitType::class, array('label' => 'Save'));
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'PropertyBundle\Entity\PropertyCategory'
    ));
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
    return 'deskimo_form_property_category';
  }


}
