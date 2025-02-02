<?php

namespace PropertyBundle\Controller\Admin;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Services\PropertyService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PropertyStatisticController extends AdminController
{
  /**
   * @Route("{id}/statistic/transaction/active-usage", name="admin_property_statistic_active_usage_route")
   * @Method("GET")
   */
  public function activeUsageAction(Request $request, $id)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      $data = $propertyService->getUsageByPropertyId($id);
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("{id}/statistic/transaction/history-usage", name="admin_property_statistic_history_usage_route")
   * @Method("GET")
   */
  public function historyUsageAction(Request $request, $id)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      $data = $propertyService->getUsageByPropertyId($id, true);
    } catch (\Exception $ex) {
      $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $ex->getMessage());
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/statistic/overview/chart", name="admin_property_statistic_overview_route")
   * @Method("GET")
   */
  public function getData4DashboardAction(Request $request)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      $data = $propertyService->getData4Dashboard();
      $data = MessageUtil::formatMessage($data);
    } catch (\Exception $ex) {
      $data = MessageUtil::getExceptionJsonMessage($ex);
    }

    return new JsonResponse($data);
  }

  /**
   * @Route("/statistic/transaction/active-usage/dashboard", name="admin_dashboard_statistic_active_usage_route")
   * @Method("GET")
   */
  public function dashboardUsageAction(Request $request)
  {
    $this->validateXmlHttpRequest($request);

    try {
      /** @var PropertyService $propertyService */
      $propertyService = $this->get(ServiceUtil::PROPERTY_SERVICE);
      $data = $propertyService->getActiveUsage4Dashboard();
    } catch (\Exception $ex) {
      $data = MessageUtil::defaultDataTableMessage();
    }

    return new JsonResponse($data);
  }
}
