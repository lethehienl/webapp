<?php
namespace PaymentBundle\Controller\BackOffice;

use AppBundle\Controller\AdminController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use PaymentBundle\Services\TransactionApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PaymentController extends AdminController
{
  /**
   * @Route("admin/payment/handle-scanner", name="payment_create_transcation_route")
   * @Method("POST")
   */
  public function handleScannerAction(Request $request)
  {
    try {
      /** @var TransactionApiService $transactionService */
      $transactionService = $this->get(ServiceUtil::TRANSACTION_API_SERVICE);
      $transactionService->handleScanner();
      $data = MessageUtil::formatMessage();
    } catch(\Exception $ex) {
      $data = MessageUtil::getExceptionJsonMessage($ex);
    }

    return $this->responseJson($data);
  }
}