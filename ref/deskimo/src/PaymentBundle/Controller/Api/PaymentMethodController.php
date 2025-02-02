<?php

namespace PaymentBundle\Controller\Api;

use AppBundle\Controller\NaviRestController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\RequestUtil;
use AppBundle\Utils\ServiceUtil;
use FOS\RestBundle\Controller\Annotations as Rest;
use PaymentBundle\Services\PaymentMethodService;
use PaymentBundle\Utils\PaymentUtil;
use Symfony\Component\HttpFoundation\Request;

class PaymentMethodController extends NaviRestController
{
  /**
   * @Rest\Post(path="api/v1/payment-info", name="api_v1_create_payment_info_route")
   */
  public function createPaymentInfoAction(Request $request) {
    try {
      /** @var PaymentMethodService $paymentMethodService */
      $paymentMethodService = $this->get(ServiceUtil::PAYMENT_METHOD_SERVICE);
      RequestUtil::validatePayloadFieldMandatory($request->request->all(), ['credit_number', 'expired_date', 'cvc_number']);
      $transformedPayload = PaymentUtil::transformCreatePaymentInfoRequestPayload($request->request->all());

      $paymentInfo = $paymentMethodService->registerPaymentMethod($this->getUser(), $transformedPayload)->decoratePaymentInfo();
      $message = MessageUtil::formatMessage($paymentInfo);
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());
      $message = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($message);
  }

  /**
   * @Rest\Get(path="api/v1/payment-info", name="api_v1_get_list_payment_info_route")
   */
  public function getPaymentInfoListAction(Request $request) {
    try {
      /** @var PaymentMethodService $paymentMethodService */
      $paymentMethodService = $this->get(ServiceUtil::PAYMENT_METHOD_SERVICE);
      $paymentInfoList = $paymentMethodService->getListOfPaymentInfoOfUser($this->getUser());
      $message = MessageUtil::formatMessage($paymentInfoList);
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());
      $message = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($message);
  }

  /*public function checkoutAndPayAction(Request $request) {
    try {
      $paymentMethodService = $this->get(ServiceUtil::PAYMENT_METHOD_SERVICE);
      RequestUtil::validatePayloadFieldMandatory($request->request->all(), ['visit_id', 'payment_method_id']);

      $paymentMethodService->pay(
        $this->getUser(),
        $request->request->get('visit_id'),
        $request->request->get('payment_method_id'),
        $this->getCurrentCurrency()
      );

      $message = MessageUtil::formatMessage();
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());
      $message = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($message);
  }*/
}
