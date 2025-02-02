<?php

namespace VisitBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\ServiceUtil;
use CompanyBundle\Utils\PropertyCompanyUtil;
use PropertyBundle\Entity\Property;
use VisitBundle\Entity\Visit;
use VisitBundle\Entity\VisitRequest;
use VisitBundle\Utils\VisitUtil;

class VisitService extends AbstractService
{
  public function manualCheckin()
  {
    $postData = $this->parseBodyRequestData();
    $requireFields = ['code'];
    $this->validateRequireFields($postData, $requireFields);

    $conditions = ['code' => $postData->code, 'status' => VisitUtil::REQUEST_PENDING_STATUS];
    /** @var VisitRequest $requestVisit */
    $requestVisit = $this->getEntityByConditions(VisitRequest::class, $conditions);
    /** @var Property $property */
    $property = null;

    if (!empty($requestVisit)) {
      $property = $requestVisit->getProperty();

      if (empty($property) && empty($this->getCurrentProperty())) {
        $this->throwException('Property is invalid');
      }

      $property = empty($property) && $this->getCurrentProperty() != PropertyCompanyUtil::ALL_PROPERTIES_VALUE ? $this->getCurrentProperty() : $property;
      $property = $this->getEntityById(Property::class, $property->getId());
    }

    if (empty($property)) {
      $this->throwException('Property is invalid');
    }

    /** @var VisitApiService $apiVisitRequest */
    $apiVisitRequest = $this->getService(ServiceUtil::VISIT_API_SERVICE);
    $apiVisitRequest->createVisit($requestVisit, $property);
  }

  public function manualCheckout($visitId)
  {
    if (empty($visitId) || !is_numeric($visitId)) {
      $this->throwException('Data is invalid');
    }

    /** @var VisitApiService $visitService */
    $visitService = $this->getService(ServiceUtil::VISIT_API_SERVICE);
    /** @var Visit $visit */
    $visit = $this->getEntityById(Visit::class, $visitId);

    if ($visit->getStatus() != VisitUtil::VISIT_ON_GOING_STATUS) {
      $this->throwException('Visit status is invalid');
    }

    $visitService->finishVisit($visit);
    $this->persist($visit, true);
  }
}
