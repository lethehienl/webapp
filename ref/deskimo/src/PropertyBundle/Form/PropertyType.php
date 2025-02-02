<?php

namespace PropertyBundle\Form;

use AppBundle\Utils\StatusUtil;
use CompanyBundle\Entity\PropertyCompany;
use PropertyBundle\Entity\PropertyCategory;
use PropertyBundle\Util\PropertyUtil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PropertyType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
      ->add('name', TextType::class, array(
        'required' => true,
      ))

      ->add('address', TextType::class, array(
        'required' => true,
      ))
      ->add('lat', HiddenType::class, array(
        'required' => false,
      ))
      ->add('lng', HiddenType::class, array(
        'required' => false,
      ))
      ->add('ratePerHour', NumberType::class, array(
        'required' => true,
      ))

      ->add('currencyCode', ChoiceType::class,
        array(
          'choices' => PropertyUtil::CURRENCY_SINGAPORE_FORM,
          'choices_as_values' => true,
          'required' => true,
        )
      )

      ->add('status', ChoiceType::class,
        array(
          'choices' => PropertyUtil::PROPERTY_STATUS_FORM,
          'choices_as_values' => true,
        )
      )
      ->add('cityCode', TextType::class, array(
        'required' => true,
      ))

      ->add('countryCode', ChoiceType::class,
        array(
          'choices' => PropertyUtil::COUNTRY_FORM,
          'choices_as_values' => true,
        )
      )


      ->add('contactEmail', TextType::class, array(
        'required' => true,
      ))
      ->add('contactName', TextType::class, array(
        'required' => true,
      ))

      ->add('contactPhone', TextType::class, array(
        'required' => true,
      ))
      ->add('about', TextareaType::class, array(
        'required' => false,
      ))
      ->add('howToGetThere', HiddenType::class, array(
        'required' => false,
      ))
      ->add('howToGetThere1', TextType::class, array(
        'required' => false,
      ))
      ->add('howToGetThere2', TextType::class, array(
        'required' => false,
      ))
      ->add('howToGetThere3', TextType::class, array(
        'required' => false,
      ))

      ->add('wifiInfo', HiddenType::class, array(
        'required' => false,
      ))
      ->add('wifiName', TextType::class, array(
        'required' => true,
      ))
      ->add('wifiPass', TextType::class, array(
        'required' => true,
      ))

      ->add('parkingAddresses', HiddenType::class, array(
        'required' => false,
      ))

      ->add('parkingAddresses1', TextType::class, array(
        'required' => false,
      ))
      ->add('parkingAddresses2', TextType::class, array(
        'required' => false,
      ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'PropertyBundle\Entity\Property'
    ));
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
    return 'deskimo_form_property';
  }
}
