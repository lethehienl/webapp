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


class PropertyScheduleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder

      ->add('schedule', HiddenType::class, array(
        'required' => false,

      ))
    ;


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
    return 'property_schedule';
  }
}
