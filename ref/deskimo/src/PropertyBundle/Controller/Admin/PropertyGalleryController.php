<?php

namespace PropertyBundle\Controller\Admin;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Entity\Property;
use PropertyBundle\Services\PropertyService;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Utils\PermissionUtil;

class PropertyGalleryController extends AdminController
{
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

  /**
   * @Route ("/{id}/images", name="property_manage_images_route")
   * @Method ("GET")
   */
  public function managePictureAction(Request $request, $id) {
    $this->denyAccessUnlessGranted(PermissionUtil::MANAGE_PROPERTY_PICTURE);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      $property = $propertyService->getEntityById(Property::class, $id);
      $this->addBreadCrumb($this->buildProperty4EditTabs($property->getName(), $property->getId()));

      return $this->renderTemplate('@Property/property/images.html.twig', [
        'property' => $property->decorate()
      ]);
    } catch(\Exception $ex) {
      return $this->redirectToRoute('property_management_route');
    }
  }

  /**
   * @Route ("/{id}/images/add", name="property_add_images_route")
   * @Method ("POST")
   */
  public function addPictureAction(Request $request, $id) {
    $this->denyAccessUnlessGranted(PermissionUtil::MANAGE_PROPERTY_PICTURE);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      /**
       * @var Property $property
       */
      $property = $propertyService->getEntityById(Property::class, $id);

      $image = $request->files->get('file');
      $this->get(ServiceUtil::PROPERTY_SERVICE)->addPropertyImage($property, $image);
      $message = MessageUtil::formatMessage($property->decorate());
      return $this->json($message);
    } catch (\Exception $ex) {
      $message = MessageUtil::formatMessage(null, $ex->getCode(), $ex->getMessage());
      return $this->json($message, Response::HTTP_FORBIDDEN);
    }

  }

  /**
   * @Route ("/{propertyId}/{pictureId}/images/delete", name="property_remove_image_route")
   * @Method ("DELETE")
   */
  public function removePictureAction(Request $request, $propertyId, $pictureId)
  {
    $this->denyAccessUnlessGranted(PermissionUtil::MANAGE_PROPERTY_PICTURE);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      /**
       * @var Property $property
       */
      $property = $propertyService->getEntityById(Property::class, $propertyId);

      $this->get(ServiceUtil::PROPERTY_SERVICE)->removePropertyImage($property, $pictureId);
      $message = MessageUtil::formatMessage($property->decorate());
      return $this->json($message);
    } catch (\Exception $ex) {
      $message = MessageUtil::formatMessage(null, $ex->getCode(), $ex->getMessage());
      return $this->json($message, Response::HTTP_FORBIDDEN);
    }
  }
}