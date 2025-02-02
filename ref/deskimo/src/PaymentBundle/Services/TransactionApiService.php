<?php

namespace PaymentBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StringUtil;
use PaymentBundle\Entity\PaymentActivity;
use PaymentBundle\Entity\PaymentInfo;
use PaymentBundle\Entity\Transaction;
use PaymentBundle\Entity\TransactionActivity;
use PaymentBundle\Entity\TransactionRequest;
use PaymentBundle\Utils\PaymentUtil;
use PaymentBundle\Utils\TransactionUtil;
use PropertyBundle\Entity\Property;
use UserBundle\Entity\CustomerPaymentGateway;
use UserBundle\Entity\User;
use VisitBundle\Entity\Visit;
use VisitBundle\Entity\VisitRequest;
use VisitBundle\Entity\VisitTracking;
use VisitBundle\Services\VisitApiService;
use VisitBundle\Utils\VisitUtil;

class TransactionApiService extends AbstractService
{
  public function checkoutAndPay()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['visit_id', 'payment_method_id'];;
    $this->validateRequireFields($postData, $requiredFields);

    $currentUser = $this->getLoggedUser();
    $visit = $this->getVisitForUser($postData->visit_id, $currentUser);
    $paymentMethod = $this->getPaymentMethod($postData->payment_method_id, $currentUser);

    $conditions = ['visit' => $visit, 'status' => TransactionUtil::REQUEST_STATUS_PENDING, 'paymentMethod' => $paymentMethod, 'user' => $currentUser];
    $transactionRequest = $this->getEntityByConditions(TransactionRequest::class, $conditions);

    if (empty($transactionRequest)) {
      $transactionRequest = new TransactionRequest();
      $transactionRequest->setStatus(TransactionUtil::REQUEST_STATUS_PENDING);
      $transactionRequest->setVisit($visit);
    }

    $transactionRequest->setUser($currentUser);
    $transactionRequest->setCode(StringUtil::generateRandomString());
    $transactionRequest->setPaymentMethod($paymentMethod);
    $transactionRequest->setExpiredDate(DateTimeUtil::createExpiredTime());
    $transactionRequest->setToken(StringUtil::generateHashToken($visit->getId() . $currentUser->getUsername() . $paymentMethod->getId()));

    $this->persist($transactionRequest, true);

    $data = ['visit_id' => $visit->getId(), 'verify_token' => $transactionRequest->getToken(), 'code' => StringUtil::displayCode($transactionRequest->getCode())];
    $specialToken = TransactionUtil::PAYMENT_TYPE . '-' . $transactionRequest->getToken() . '-' . $transactionRequest->getCode();
    $data['qr_code_token'] = $specialToken;

    return $data;
  }

  public function verifyTransaction()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['code', 'verify_token', 'visit_id'];
    $this->validateRequireFields($postData, $requiredFields);

    $conditions = ['id' => $postData->visit_id, 'status' => VisitUtil::VISIT_FINISHED_STATUS];
    $visit = $this->getEntityByConditions(Visit::class, $conditions);

    if (empty($visit)) {
      $this->throwException('Visit is invalid');
    }

    $data = ['is_checkout' => true, 'is_paid' => false];
    $conditions = ['code' => $postData->code, 'token' => $postData->verify_token, 'visit' => $visit];

    /** @var Transaction $transaction */
    $transaction = $this->getEntityByConditions(Transaction::class, $conditions);

    if (empty($transaction)) {
      return $data;
    }

    $data['is_paid'] = $transaction->getStatus() == TransactionUtil::SUCCESS;
    return $data;
  }

  private function getPaymentMethod($paymentMethodId, User $user)
  {
    $conditions = ['user' => $user, 'id' => $paymentMethodId];
    /** @var PaymentInfo $paymentMethod */
    $paymentMethod = $this->getEntityByConditions(PaymentInfo::class, $conditions);

    if (empty($paymentMethod)) {
      $this->throwException('Payment method not found');
    }

    return $paymentMethod;
  }

  private function getVisitForUser($visitId, User $user)
  {
    $conditions = ['user' => $user, 'id' => $visitId];
    /** @var Visit $visit */
    $visit = $this->getEntityByConditions(Visit::class, $conditions);

    if (empty($visit)) {
      $this->throwException('Visit not found');
    }

    return $visit;
  }

  public function handleScanner()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['token'];
    $this->validateRequireFields($postData, $requiredFields);

    $validData = explode('-', $postData->token);

    if (count($validData) < 3) {
      $this->throwException('Data is invalid');
    }

    $type = $validData[0];
    $verifyToken = $validData[1];
    $code = $validData[2];

    switch($type) {
      case TransactionUtil::CHECKIN_TYPE:
        /** @var VisitApiService $visitService */
        $visitService = $this->getService(ServiceUtil::VISIT_API_SERVICE);
        $visitService->allowCheckin($code, $verifyToken);
        break;

      case TransactionUtil::PAYMENT_TYPE:
        $this->makeTransaction($code, $verifyToken);
        break;

      case TransactionUtil::RE_ENTER_TYPE:
        $this->allowEnterAgain($code, $verifyToken);
        break;
    }
  }

  private function allowEnterAgain($code, $token)
  {
    $conditions = ['code' => $code, 'token' => $token];
    /** @var VisitTracking $visitTracking */
    $visitTracking = $this->getEntityByConditions(VisitTracking::class, $conditions);

    if (empty($visitTracking)) {
      $this->throwException('Data is invalid');
    }

    $visitTracking->setStatus(VisitUtil::RE_ENTER_ACCEPTED_STATUS);
    $this->persist($visitTracking, true);
  }

  private function makeTransaction($code, $token)
  {
    $conditions = ['code' => $code, 'token' => $token, 'status' => TransactionUtil::REQUEST_STATUS_PENDING];
    /** @var TransactionRequest $paymentRequest */
    $paymentRequest = $this->getEntityByConditions(TransactionRequest::class, $conditions);

    if (empty($paymentRequest)) {
      $this->throwException('Data is invalid', 1008);
    }

    $paymentRequest->setCode(StringUtil::updateCode($paymentRequest->getId(), $paymentRequest->getCode()));
    $paymentRequest->setStatus(TransactionUtil::REQUEST_STATUS_ACCEPTED);
    $this->persist($paymentRequest);

    /** @var Visit $visit */
    $visit = $paymentRequest->getVisit();

    /** @var VisitApiService $visitService */
    $visitService = $this->getService(ServiceUtil::VISIT_API_SERVICE);
    $visitService->finishVisit($visit);
    $this->persist($visit, true);

    $this->doPayment($paymentRequest, $visit);
  }

  private function doPayment(TransactionRequest $paymentRequest, Visit $visit)
  {
    try {
      $transaction = new Transaction();
      $transaction->setCode($paymentRequest->getCode());
      $transaction->setToken($paymentRequest->getToken());

      $transaction->setVisit($visit);
      $transaction->setRequest($paymentRequest);
      $transaction->setCurrency($visit->getPaymentCurrency());

      /** @var StripeService $stripeService */
      $stripeService = $this->getContainer()->get(ServiceUtil::STRIPE_SERVICE);
      $amountData = ['amount' => $visit->getTotalPrice(), 'currency' => strtolower($transaction->getCurrency())];

      $paymentInfo = $paymentRequest->getPaymentMethod();
      $transaction->setPaymentInfo($paymentInfo);
      $transaction->setAmount($visit->getTotalPrice());
      $paymentGatewayChargeResponse = $stripeService->pay($paymentInfo, $amountData);

      if ($paymentGatewayChargeResponse['status'] == 'succeeded') {
        $transaction->setStatus(TransactionUtil::SUCCESS);
        $visit->setStatus(VisitUtil::VISIT_FINISH_PAYMENT_STATUS);
        $this->persist($visit);
      } else {
        $transaction->setStatus(TransactionUtil::PENDING);
      }

      $transactionActivity = new TransactionActivity();
      $transactionActivity->setLog(json_encode($paymentGatewayChargeResponse));
      $transaction->addTransactionActivity($transactionActivity);
      $transaction->setTransactionRef($paymentGatewayChargeResponse['transaction_ref']);

      $this->persist($transaction, true);
    } catch(\Exception $ex) {
      $this->writeLog($ex->getMessage());
    }
  }
}
