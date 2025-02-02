<?php

namespace PropertyBundle\Controller\Admin;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Entity\Amenity;
use PropertyBundle\Entity\Property;
use PropertyBundle\Entity\PropertyBenefit;
use PropertyBundle\Form\AmenityType;
use PropertyBundle\Form\PropertyBenefitType;
use PropertyBundle\Services\PropertyBenefitService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use PropertyBundle\Form\PropertyType;

class PropertyBenefitController extends AdminController
{
  /**
   * @Route("/benefit", name="property_benefit_management_route")
   * @Method("GET")
   */
  public function indexAction(Request $request)
  {
    return $this->render('@Property/benefit/index.html.twig');
  }

  /**
   * @Route("/benefit/search", name="property_benefit_management_search_route")
   * @Method("GET")
   */
  public function searchAction(Request $request)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var PropertyBenefitService $propertyBenefitService */
      $propertyBenefitService = $this->get(ServiceUtil::PROPERTY_BENEFIT_SERVICE);
      $data = $propertyBenefitService->getDatatable();
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/benefit/create", name="property_benefit_management_create_route")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
    $amenity = new Amenity();
    $form = $this->createForm(AmenityType::class, $amenity);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $session = $request->getSession();

      try {
        /** @var PropertyBenefitService $propertyBenefitService */
        $propertyBenefitService = $this->get(ServiceUtil::PROPERTY_BENEFIT_SERVICE);
        $propertyBenefitService->create($amenity);
        $message = 'The "' . $amenity->getName() . '" created successfully.';
        $session->getFlashBag()->add('success', $message);

        return $this->redirectToRoute('property_benefit_management_route');
      } catch (\Exception $ex) {
        $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' CREATE Amenity: ' . $ex->getMessage());
        $session->getFlashBag()->add('error', 'Add amenity fail');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Add New Property Benefit',
    );

    return $this->render('@Property/benefit/new.html.twig', $data);
  }

  /**
   * @Route("/benefit/{id}/delete", name="property_benefit_management_delete_route")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    try {
      /** @var PropertyBenefitService $propertyBenefitService */
      $propertyBenefitService = $this->container->get(ServiceUtil::PROPERTY_BENEFIT_SERVICE);
      /** @var Property $property */
      $propertyBenefit = $propertyBenefitService->getDetail($id);
      if (isset($propertyBenefit)) {

        if ($propertyBenefitService->delete($propertyBenefit)) {
          $response = MessageUtil::formatFoMessageAdmin(200, 'Success');
        }
      } else {
        $message = 'Not Authorize';
        $response = MessageUtil::formatFoMessageAdmin(400, $message);
      }
    } catch (\Exception $ex) {
      $message = 'Not Authorize';
      $response = MessageUtil::formatFoMessageAdmin($ex->getCode(), $message);
    }

    return new JsonResponse($response);
  }

  /**
   * @Route("/benefit/{id}/update", name="property_benefit_management_edit_route")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, $id)
  {
    $session = $request->getSession();

    try {
      /** @var PropertyBenefitService $propertyBenefitService */
      $propertyBenefitService = $this->container->get(ServiceUtil::PROPERTY_BENEFIT_SERVICE);

      /** @var Amenity $property */
      $amenity = $propertyBenefitService->getDetail($id);

      if (isset($amenity)) {

        /*$currentUser = $this->getUser();*/

        $form = $this->createForm(AmenityType::class, $amenity);
       /* $form->add('imageTmp')->add('imageTmp', FileType::class, array(
          'label' => 'Image',
          'required' => false,
        ));*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          /** @var Amenity $amenity */
          /*$propertyBenefit->setUpdatedBy($currentUser->getId());*/

          $propertyBenefitService->update($amenity);
          $message = 'The "' . $amenity->getName() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);
          return $this->redirectToRoute('property_benefit_management_route');
        }

        return $this->render('@Property/benefit/update.html.twig', array(
          'form' => $form->createView(),
          'page_title' => 'Edit Property Benefit',
        ));
      }
    } catch (\Exception $ex) {

      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('property_benefit_management_route');
    }
  }
}
