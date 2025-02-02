<?php

namespace VisitBundle\Controller\Api;

use AppBundle\Controller\NaviRestController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use VisitBundle\Services\VisitApiService;

class VisitController extends NaviRestController
{
  /**
   * @Rest\Post(path="api/v1/check-in/request/{property_id}", name="api_request_checking_route")
   */
  public function requestCheckinAction(Request $request, $property_id = null)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitInfo = $visitService->requestCheckin($property_id);
      $data = MessageUtil::formatMessage($visitInfo);
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Post(path="api/v1/check-in/verify", name="api_request_checking_verification_route")
   */
  public function verifyCheckinAction(Request $request)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitInfo = $visitService->verifyCheckin();
      $data = MessageUtil::formatMessage($visitInfo);
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Post(path="api/v1/re-enter", name="api_request_re_enter_route")
   */
  public function reEnterAction(Request $request)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitInfo = $visitService->reEnter();
      $data = MessageUtil::formatMessage($visitInfo);
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Post(path="api/v1/re-enter/verify", name="api_request_re_enter_verification_route")
   */
  public function verifyReEnterAction(Request $request)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitInfo = $visitService->verifyReEnter();
      $data = MessageUtil::formatMessage($visitInfo);
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Post(path="api/v1/visit-history/{last_id}", name="api_visit_history_route")
   */
  public function getVisitHistoryAction(Request $request, $last_id = null)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitInfo = $visitService->getVisitHistory($last_id);
      $data = MessageUtil::formatMessage($visitInfo);
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Get(path="api/v1/check-in/on-going", name="api_request_checking_on_going_route")
   */
  public function getOngoIngVisitAction(Request $request)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitInfo = $visitService->getOnGoingVisit();
      $data = MessageUtil::formatMessage($visitInfo);
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Get(path="api/v1/visit/{id}", name="api_request_get_visit_detail_route")
   */
  public function getVisitDetailAction(Request $request, $id)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitInfo = $visitService->getVisitDetail($id);
      $data = MessageUtil::formatMessage($visitInfo);
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Post(path="api/v1/visit-evaluation", name="api_visit_evaluation_create_route")
   */
  public function createEvaluation(Request $request)
  {
    try {
      /** @var VisitApiService $visitService */
      $visitService = $this->get(ServiceUtil::VISIT_API_SERVICE);
      $visitService->createVisitEvaluation();
      $data = MessageUtil::formatMessage();
    } catch (\Exception $ex) {
      $visitService->writeLog($ex->getMessage());
      $data = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($data);
  }
}
