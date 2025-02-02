<?php

namespace PropertyBundle\Controller\Admin;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Entity\Property;
use PropertyBundle\Form\AmenityCustomType;
use PropertyBundle\Form\PropertyScheduleType;
use PropertyBundle\Services\PropertyBenefitService;
use PropertyBundle\Services\PropertyService;
use PropertyBundle\Util\PropertyUtil;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use PropertyBundle\Form\PropertyType;

class PropertyController extends AdminController
{
  /**
   * @Route("/", name="property_management_route")
   * @Method("GET")
   */
  public function indexAction(Request $request)
  {
    return $this->renderTemplate('@Property/property/index.html.twig');
  }

  /**
   * @Route("/search", name="property_management_search_route")
   * @Method("GET")
   */
  public function searchAction(Request $request)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      $data = $propertyService->getDatatable();
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/create", name="property_management_create_route")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {

    /** @var PropertyBenefitService $benefitService */
    $benefitService = $this->get(ServiceUtil::PROPERTY_BENEFIT_SERVICE);
    $formData = array(
      /*'benefit' => $benefitService->getActiveBenefit(true),
      'defaultBenefit' => array(),*/
    );

    $property = new Property();
    $form = $this->createForm(PropertyType::class, $property, $formData);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $session = $request->getSession();

      try {
        /** @var PropertyService $propertyService */
        $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
        $propertyService->create($property);
        $message = 'The "' . $property->getName() . '" created successfully.';
        $session->getFlashBag()->add('success', $message);

        return $this->redirectToRoute('property_add_images_route', array('id' => $property->getId()));
      } catch (\Exception $ex) {
        $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' CREATE Property: ' . $ex->getMessage());
        $session->getFlashBag()->add('error', 'Add property fail');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Add New Property',
    );

    $this->addBreadCrumb(['property_management_create_route' => 'General Information']);

    return $this->renderTemplate('@Property/property/new.html.twig', $data);
  }

  /**
   * @Route("/{id}/delete", name="property_management_delete_route")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->container->get(ServiceUtil::PROPERTY_SERVICE);
      /** @var Property $property */
      $property = $propertyService->getDetail($id);
      if (isset($property)) {
        $property->setStatus(PropertyUtil::PROPERTY_STATUS_NOT_ACTIVE_CODE);

        if ($propertyService->save($property)) {
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
   * @Route("/{id}/update", name="property_management_edit_route")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, $id)
  {
    $session = $request->getSession();

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->container->get(ServiceUtil::PROPERTY_SERVICE);

      /** @var Property $property */
      $property = $propertyService->getDetail($id);

      if (isset($property)) {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $propertyService->update($property);
          $message = 'The "' . $property->getName() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);

          return $this->redirectToRoute('property_add_images_route', array('id' => $property->getId()));
        }
      }
    } catch (\Exception $ex) {
      dump($ex);die;
      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('property_management_route');
    }

    $this->addBreadCrumb($this->buildProperty4EditTabs($property->getName(), $property->getId()));

    return $this->renderTemplate('@Property/property/update.html.twig', array(
      'form' => $form->createView(),
      'page_title' => 'Edit Property',
    ));
  }

  private function buildProperty4EditTabs($propertyName, $propertyId)
  {
    $params = ['id' => $propertyId];
    $tabs = [
      $this->generateUrl('admin_property_detail_route', $params) => $propertyName,
      $this->generateUrl('property_management_edit_route', $params) => 'Update',
      $this->generateUrl('property_manage_images_route', $params) => 'Photos',
      $this->generateUrl('property_management_edit_amenity_route', $params) => 'Amenities',
      $this->generateUrl('property_management_edit_schedule_route', $params) => 'Schedule'
    ];

    return $tabs;
  }

  private function buildProperty4DetailTabs($propertyName, $propertyId)
  {
    $params = ['id' => $propertyId];
    $tabs = [
      $this->generateUrl('admin_property_detail_route', $params) => $propertyName,
      $this->generateUrl('admin_property_usage_route', $params) => 'Usage',
    ];

    return $tabs;
  }

  /**
   * @Route("/{id}/usage", name="admin_property_usage_route")
   * @Method("GET")
   */
  public function usageAction(Request $request, $id)
  {
    /** @var PropertyService $propertyService */
    $propertyService = $this->container->get(ServiceUtil::PROPERTY_SERVICE);
    /** @var Property $property */
    $property = $propertyService->getDetail($id);

    if (!empty($property)) {
      $this->addBreadCrumb($this->buildProperty4DetailTabs($property->getName(), $property->getId()));
      return $this->renderTemplate('@Property/property/usage.html.twig', ['property_id' => $property->getId()]);
    }

    return $this->redirectToRoute('property_management_route');
  }

  /**
   * @Route("/{id}/detail", name="admin_property_detail_route")
   * @Method("GET")
   */
  public function detailAction(Request $request, $id)
  {
    /** @var PropertyService $propertyService */
    $propertyService = $this->container->get(ServiceUtil::PROPERTY_SERVICE);

    /** @var Property $property */
    $property = $propertyService->getDetail($id);
    $data = $propertyService->getDetailShow($id);

    if (isset($property)) {
      $this->addBreadCrumb($this->buildProperty4DetailTabs($property->getName(), $property->getId()));
      return $this->renderTemplate('@Property/property/detail.html.twig', array('property' => $property, 'data' => $data));
    }

    return $this->redirectToRoute('property_management_route');
  }

  /**
   * @Route("/{id}/amenity/update", name="property_management_edit_amenity_route")
   * @Method({"GET", "POST"})
   */
  public function editAmenityAction(Request $request, $id)
  {
    $session = $request->getSession();

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->container->get(ServiceUtil::PROPERTY_SERVICE);

      /** @var Property $property */
      $property = $propertyService->getDetail($id);

      if (isset($property)) {
        $this->addBreadCrumb($this->buildProperty4EditTabs($property->getName(), $property->getId()));

        /** @var PropertyBenefitService $benefitService */
        $benefitService = $this->get(ServiceUtil::PROPERTY_BENEFIT_SERVICE);
        $formData = array(
          'amenity' => $benefitService->getActiveBenefit(true),
          'defaultAmenityPaid' => $propertyService->getBenefitPaidDefaults($property),
          'defaultAmenityFree' => $propertyService->getBenefitFreeDefaults($property),
        );

        $form = $this->createForm(AmenityCustomType::class, null, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

          /** @var Property $property */
          $data['amenityFree'] = !empty($request->get('amenityFree')) ? $request->get('amenityFree') : array();
          $data['amenityPaid'] = !empty($request->get('amenityPaid')) ? $request->get('amenityPaid') : array();

          $benefitService->updatePropertyAmenity($property, $data);
          $message = 'The "' . $property->getName() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);
          return $this->redirectToRoute('property_management_edit_schedule_route', ['id' => $id]);
        }

        return $this->renderTemplate('@Property/amenity/update.html.twig', array(
          'form' => $form->createView(),
          'page_title' => 'Edit Property',
          'amenity' => $formData['amenity'],
          'defaultAmenityPaid' => $formData['defaultAmenityPaid'],
          'defaultAmenityFree' => $formData['defaultAmenityFree'],
        ));
      }
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('property_management_route');
    }
  }

  /**
   * @Route("/{id}/schedule/update", name="property_management_edit_schedule_route")
   * @Method({"GET", "POST"})
   */
  public function editScheduleAction(Request $request, $id)
  {
    $session = $request->getSession();

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->container->get(ServiceUtil::PROPERTY_SERVICE);

      /** @var Property $property */
      $property = $propertyService->getDetail($id);
      $schedule = !empty($property->getSchedule()) ? json_decode($property->getSchedule(), true) : array();

      if (isset($property)) {
        $this->addBreadCrumb($this->buildProperty4EditTabs($property->getName(), $property->getId()));
        $form = $this->createForm(PropertyScheduleType::class, $property);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

          $data['openHour'] = !empty($request->get('openHour')) ? $request->get('openHour') : array();
          $data['community'] = !empty($request->get('community')) ? $request->get('community') : array();
          $data['aircon'] = !empty($request->get('aircon')) ? $request->get('aircon') : array();

          $propertyService->updateSchedule($property, $data);
          $message = 'The "' . $property->getName() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);
          return $this->redirectToRoute('property_management_route');
        }

        return $this->renderTemplate('@Property/schedule/update.html.twig', array(
          'form' => $form->createView(),
          'page_title' => 'Edit Property Schedule',
          'schedule' => $schedule,
        ));
      }
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('property_management_route');
    }
  }

  /**
   * @Route("/usage/testfdfd/teststest", name="property_usage_html_route")
   * @Method("GET")
   */
  public function usagetestAction(Request $request)
  {
    return $this->renderTemplate('@Property/property/usage.html.twig');
  }
}
