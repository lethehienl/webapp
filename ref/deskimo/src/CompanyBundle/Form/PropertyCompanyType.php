<?php

namespace CompanyBundle\Form;

use AppBundle\Utils\StatusUtil;
use PropertyBundle\Util\PropertyUtil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use UserBundle\Util\UserStatusUtil;

class PropertyCompanyType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, array(
        'label' => 'Name',
        'required' => true,
      ))
      ->add('contactPhone', TextType::class, array(
        'label' => 'Contact Phone',
        'required' => true,
      ))
      ->add('contactName', TextType::class, array(
        'label' => 'Contact Name',
        'required' => true,
      ))
      ->add('shareRevenuePercent', NumberType::class, array(
        'required' => true,
        'scale' => 2,
        'attr' => array('step' => '0.01', 'type' => 'number', 'value' => '35')
      ))
      ->add('status', ChoiceType::class,
        array(
          'choices' => StatusUtil::STATUS_MAPPING_FORM,
          'choices_as_values' => true,
        )
      )

      ->add('invoiceDueTime', NumberType::class, array(
        'label' => 'Payment terms in days',
        'required' => true,
        'scale' => 2,
        'attr' => array('step' => '0.01', 'type' => 'number', 'value' => '60 day', 'readonly' => true)
      ))

      ->add('invoiceDurationTime', TextType::class, array(
        'label' => 'Invoice is generated monthly (last day of the month) ',
        'required' => true,
        'attr' => array('value' => '1 month', 'readonly' => true)
      ))

      ->add('currency', ChoiceType::class,
        array(
          'label' => 'Currency',
          'choices' => PropertyUtil::CURRENCY_SINGAPORE_FORM,
          'choices_as_values' => true,
          'required' => true,
        )
      )
      ->add('processingFree', NumberType::class, array(
        'label' => 'Processing fee',
        'required' => true,
        'scale' => 2,
        'attr' => array('step' => '0.01', 'type' => 'number', 'value' => '5', 'readonly' => true)
      ))
    ;

    // $builder->add('save', SubmitType::class, array('label' => 'Save'));

  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'CompanyBundle\Entity\PropertyCompany',
      'is_add' => false,
    ));
    $resolver->setAllowedTypes('is_add', 'bool');
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
    return 'deskimo_form_property_companhy';
  }
}
