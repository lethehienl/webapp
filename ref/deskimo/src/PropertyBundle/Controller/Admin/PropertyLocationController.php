<?php

namespace PropertyBundle\Controller\Admin;

use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Entity\Property;
use PropertyBundle\Entity\PropertyLocation;
use PropertyBundle\Form\PropertyLocationType;
use PropertyBundle\Services\PropertyLocationService;
use PropertyBundle\Services\PropertyTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class PropertyLocationController extends Controller
{
  /**
   * @Route("/location", name="property_location_management_route")
   * @Method("GET")
   */
  public function indexAction(Request $request)
  {
    return $this->render('@Property/location/index.html.twig');
  }

  /**
   * @Route("/location/search", name="property_location_management_search_route")
   * @Method("GET")
   */
  public function searchAction(Request $request)
  {
    if (!$request->isXmlHttpRequest()) {
      throw new AccessDeniedException();
    }

    try {
      /** @var PropertyLocationService $propertyLocationService */
      $propertyLocationService = $this->get(ServiceUtil::PROPERTY_LOCATION_SERVICE);
      $data = $propertyLocationService->getDatatable();
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/location/create", name="property_location_management_create_route")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {

    $propertyLocation = new PropertyLocation();
    $form = $this->createForm(PropertyLocationType::class, $propertyLocation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $session = $request->getSession();

      try {
        /** @var PropertyLocationService $propertyLocationService */
        $propertyLocationService = $this->get(ServiceUtil::PROPERTY_LOCATION_SERVICE);
        $propertyLocationService->create($propertyLocation);
        $message = 'The "' . $propertyLocation->getName() . '" created successfully.';
        $session->getFlashBag()->add('success', $message);

        return $this->redirectToRoute('property_location_management_route');
      } catch (\Exception $ex) {
        $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' CREATE Property Location: ' . $ex->getMessage());
        $session->getFlashBag()->add('error', 'Add property location fail');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Add New Property Location',
    );

    return $this->render('@Property/location/new.html.twig', $data);
  }

  /**
   * @Route("/location/{id}/delete", name="property_location_management_delete_route")
   * @Method({"GET", "POST"})
   */
  public function deleteAction(Request $request, $id)
  {
    try {
      /** @var PropertyLocationService $propertyLocationService */
      $propertyLocationService = $this->container->get(ServiceUtil::PROPERTY_LOCATION_SERVICE);
      /** @var PropertyLocation $propertyLocation */
      $propertyLocation = $propertyLocationService->getDetail($id);
      if (isset($propertyLocation)) {
        //$currentUser = $this->getUser();
        //$propertyLocation->setUpdatedBy($currentUser->getId());

        if ($propertyLocationService->delete($propertyLocation)) {
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
   * @Route("/location/{id}/update", name="property_location_management_edit_route")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, $id)
  {
    $session = $request->getSession();

    try {
      /** @var PropertyLocationService $propertyLocationService */
      $propertyLocationService = $this->container->get(ServiceUtil::PROPERTY_LOCATION_SERVICE);

      /** @var PropertyLocation $propertyLocation */
      $propertyLocation = $propertyLocationService->getDetail($id);

      if (isset($propertyLocation)) {

        //$currentUser = $this->getUser();

        $form = $this->createForm(PropertyLocationType::class, $propertyLocation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $propertyLocationService->update($propertyLocation);
          $message = 'The "' . $propertyLocation->getName() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);
          return $this->redirectToRoute('property_location_management_route');
        }

        return $this->render('@Property/location/update.html.twig', array(
          'form' => $form->createView(),
          'page_title' => 'Edit Property',
        ));
      }
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('property_location_management_route');
    }
  }
}
