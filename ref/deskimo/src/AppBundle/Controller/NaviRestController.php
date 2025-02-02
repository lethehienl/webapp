<?php

namespace AppBundle\Controller;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\ServiceUtil;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use PaymentBundle\Utils\PaymentUtil;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Utils\UserUtil;

class NaviRestController extends AbstractFOSRestController
{
  public function getCurrentLocale() {
   return $this->get(AbstractService::class)->getCurrentLocale();
  }

  public function getCurrentCurrency() {
    $currentLocale = $this->get('request_stack')->getCurrentRequest()->headers->get('Locale');

    if (!$currentLocale) {
      $currentLocale = UserUtil::EN_LOCALE;
    }

    $currency = PaymentUtil::LOCALE_CURRENCY_MAPPING[$currentLocale];

    if (!$currency) {
      return PaymentUtil::EN_CURRENCY;
    }

    return $currency;
  }

  public function responseJson($data)
  {
    return new JsonResponse($data);
  }

  public function writeLog($message)
  {
    $this->get(ServiceUtil::LOGGER_SERVICE)->err(__FUNCTION__ . ' ' . $message);
  }

  public function parseBodyRequest(Request $request, $asArray = true)
  {
    $data = $request->getContent();

    if (empty($data)) {
      throw new \Exception('Data is invalid', 1000);
    }

    try {
      return json_decode($data, $asArray);
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . '-' . $ex->getMessage());
      throw new \Exception('Data is invalid', 1000);
    }
  }
}