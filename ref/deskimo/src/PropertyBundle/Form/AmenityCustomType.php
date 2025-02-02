<?php

namespace PropertyBundle\Form;

use PropertyBundle\Util\PropertyUtil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
use Symfony\Component\Validator\Constraints\IsTrue;
use UserBundle\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use UserBundle\Util\UserStatusUtil;

class AmenityCustomType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $amenity = $options['amenity'];
    $defaultAmenityPaid = $options['defaultAmenityPaid'];
    $defaultAmenityFree =$options['defaultAmenityFree'];
    $builder->add('amenityFree', HiddenType::class);
    $builder->add('amenityPaid', HiddenType::class);

   /* $builder
      ->add('amenityFree', ChoiceType::class, array(
        'required' => true,
        'label' => 'Amenity Free',
        'choices' => $amenity,
        'data' => $defaultAmenityFree,
        'attr' => array('class' => 'select2 form-control'),
        'multiple' => true,
        //'expanded ' => true,
        //'checkboxes' => true
        'preferred_choices' => ['muppets', 'arr'],
      ))

      ->add('amenityPaid', ChoiceType::class, array(
        'required' => true,
        'label' => 'Amenity Paid',
        'choices' => $amenity,
        'data' => $defaultAmenityPaid,
        'attr' => array('class' => 'select2 form-control'),
        'multiple' => true,
      ))
      ->add('agreeTerms', CheckboxType::class, [
        'mapped' => false,
        'label' => 'Test',
        'data' =>true,
      ])
      ;*/

    //$index = 0;
    /*foreach ($amenity as $key => $value) {
      $builder ->add('amenityFree_' . $value, CheckboxType::class,
        array(
          'mapped' => false,
          'label' => $key,
          'data' => in_array($value, $defaultAmenityFree) ? true : false,
        )
      );
    }
    foreach ($amenity as $key => $value) {
      $builder ->add('amenityPaid_' . $value, CheckboxType::class,
        array(
          'mapped' => false,
          'label' => $key,
          'data' => in_array($value, $defaultAmenityPaid) ? true : false,
        )
      );
    }*/

  }


  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'amenity' => array(),
      'defaultAmenityPaid' => array(),
      'defaultAmenityFree' => array(),
    ));
  }
  public function getBlockPrefix()
  {
    return 'amenity';
  }

}
