<?php

namespace PaymentBundle\Controller\Api;

use AppBundle\Controller\NaviRestController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PaymentBundle\Services\TransactionApiService;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class TransactionController extends NaviRestController
{
  /**
   * @Rest\Post(path="api/v1/checkout-and-pay", name="api_checkout_and_pay_route")
   */
  public function checkoutAndPayAction(Request $request) {
    try {
      /** @var TransactionApiService $transactionService */
      $transactionService = $this->get(ServiceUtil::TRANSACTION_API_SERVICE);
      $data = $transactionService->checkoutAndPay();
      $message = MessageUtil::formatMessage($data);
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());
      $message = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($message);
  }

  /**
   * @Rest\Post(path="api/v1/verify-transaction", name="api_verify_transaction_route")
   */
  public function verifyTransactionAction(Request $request) {
    try {
      /** @var TransactionApiService $transactionService */
      $transactionService = $this->get(ServiceUtil::TRANSACTION_API_SERVICE);
      $data = $transactionService->verifyTransaction();
      $message = MessageUtil::formatMessage($data);
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());
      $message = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($message);
  }
}
