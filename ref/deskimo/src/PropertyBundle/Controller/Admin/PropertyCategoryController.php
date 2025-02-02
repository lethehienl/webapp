<?php

namespace PropertyBundle\Controller\Admin;

use PropertyBundle\Form\PropertyCategoryType;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Entity\Property;
use PropertyBundle\Entity\PropertyCategory;
use PropertyBundle\Services\PropertyCategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PropertyCategoryController extends Controller
{
  /**
   * @Route("/category", name="property_category_management_route")
   * @Method("GET")
   */
  public function indexAction(Request $request)
  {
    return $this->render('@Property/category/index.html.twig');
  }

  /**
   * @Route("/category/search", name="property_category_management_search_route")
   * @Method("GET")
   */
  public function searchAction(Request $request)
  {
    /*if (!$request->isXmlHttpRequest()) {
      throw new AccessDeniedException();
    }*/

    try {
      /** @var PropertyCategoryService $propertyCategoryService */
      $propertyCategoryService = $this->get(ServiceUtil::PROPERTY_CATEGORY_SERVICE);
      $data = $propertyCategoryService->getDatatable();
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/category/create", name="property_category_management_create_route")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
    $propertyCategory = new PropertyCategory();
    $form = $this->createForm(PropertyCategoryType::class, $propertyCategory);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $session = $request->getSession();

      try {
        /** @var PropertyCategoryService $propertyCategoryService */
        $propertyCategoryService = $this->get(ServiceUtil::PROPERTY_CATEGORY_SERVICE);
        $propertyCategoryService->create($propertyCategory);
        $message = 'The "' . $propertyCategory->getName() . '" created successfully.';
        $session->getFlashBag()->add('success', $message);

        return $this->redirectToRoute('property_category_management_route');
      } catch (\Exception $ex) {
        $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' CREATE Property Category: ' . $ex->getMessage());
        $session->getFlashBag()->add('error', 'Add property category fail');
      }
    }

    $data = array(
      'form' => $form->createView(),
      'page_title' => 'Add New Property Category',
    );

    return $this->render('@Property/category/new.html.twig', $data);
  }

  /**
   * @Route("/category/{id}/delete", name="property_category_management_delete_route")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    try {
      /** @var PropertyCategoryService $propertyCategoryService */
      $propertyCategoryService = $this->container->get(ServiceUtil::PROPERTY_CATEGORY_SERVICE);
      /** @var PropertyCategory $propertyCategory */
      $propertyCategory = $propertyCategoryService->getDetail($id);
      if (isset($propertyCategory)) {
        /*$currentUser = $this->getUser();
        $property->setUpdatedBy($currentUser->getId());*/

        if ($propertyCategoryService->delete($propertyCategory)) {
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
   * @Route("/category/{id}/update", name="property_category_management_edit_route")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, $id)
  {

    $session = $request->getSession();

    try {
      /** @var PropertyCategoryService $propertyCategoryService */
      $propertyCategoryService = $this->container->get(ServiceUtil::PROPERTY_CATEGORY_SERVICE);

      /** @var PropertyCategory $propertyCategory */
      $propertyCategory = $propertyCategoryService->getDetail($id);

      if (isset($propertyCategory)) {

        /*$currentUser = $this->getUser();*/

        $form = $this->createForm(PropertyCategoryType::class, $propertyCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          /** @var PropertyCategoryType $propertyCategory */
          /*$property->setUpdatedBy($currentUser->getId());*/

          $propertyCategoryService->update($propertyCategory);
          $message = 'The "' . $propertyCategory->getName() . '" updated successfully.';
          $session->getFlashBag()->add('success', $message);
          return $this->redirectToRoute('property_category_management_route');
        }

        return $this->render('@Property/category/update.html.twig', array(
          'form' => $form->createView(),
          'page_title' => 'Edit Property Category',
        ));
      }
    } catch (\Exception $ex) {

      $message = MessageUtil::getBusinessMessage($ex);
      $session->getFlashBag()->add('error', $message);
      return $this->redirectToRoute('property_category_management_route');
    }
  }
}
