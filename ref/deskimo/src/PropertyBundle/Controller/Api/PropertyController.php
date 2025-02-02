<?php

namespace PropertyBundle\Controller\Api;

use AppBundle\Controller\NaviRestController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Services\PropertyApiService;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class PropertyController extends NaviRestController
{
  /**
   * @Rest\Post(path="api/v1/properties", name="api_search_property_route")
   */
  public function getPropertiesAction(Request $request)
  {
    try {
      /** @var PropertyApiService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_API_SERVICE);
      $properties = $propertyService->searchPropertiesFromElasticSearch();
      $data = MessageUtil::formatMessage($properties);
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Get(path="api/v1/property/{id}", name="api_get_property_route")
   */
  public function getPropertyAction(Request $request, $id)
  {
    try {
      /** @var PropertyApiService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_API_SERVICE);
      $property = $propertyService->getProperty($id);
      $data = MessageUtil::formatMessage($property);
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }
}
