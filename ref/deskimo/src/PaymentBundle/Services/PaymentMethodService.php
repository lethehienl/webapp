<?php

namespace PaymentBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\ServiceUtil;
use PaymentBundle\Entity\PaymentActivity;
use PaymentBundle\Entity\PaymentInfo;
use PaymentBundle\Entity\Transaction;
use PaymentBundle\Entity\TransactionActivity;
use PaymentBundle\Utils\PaymentUtil;
use UserBundle\Entity\CustomerPaymentGateway;
use UserBundle\Entity\User;
use VisitBundle\Entity\Visit;

class PaymentMethodService extends AbstractService
{
  private $paymentGatewayType;

  private $paymentInfo;

  /**
   * @return mixed
   */
  public function getPaymentGatewayType()
  {
    if (!$this->paymentGatewayType) {
      return PaymentUtil::STRIPE_GATEWAY_TYPE;
    }

    return $this->paymentGatewayType;
  }

  /**
   * @param mixed $paymentGatewayType
   */
  public function setPaymentGatewayType($paymentGatewayType)
  {
    $this->paymentGatewayType = $paymentGatewayType;
    return $this;
  }

  /**
   * @return PaymentInfo
   */
  public function getPaymentInfo()
  {
    return $this->paymentInfo;
  }

  /**
   * @param mixed $paymentInfo
   */
  public function setPaymentInfo($paymentInfo)
  {
    $this->paymentInfo = $paymentInfo;
  }

  /**
   * @param string $paymentGatewayType
   * @return object|StripeService|null
   */
  private function getPaymentServiceFactory()
  {
    switch ($this->getPaymentGatewayType()) {
      case PaymentUtil::STRIPE_GATEWAY_TYPE:
      default:
        $paymentService = $this->getContainer()->get(ServiceUtil::STRIPE_SERVICE);
    }

    if (!($paymentService instanceof PaymentServiceClientInterface)) {
      throw new \Exception('Service need to implement PaymentServiceClientInterface to go further!');
    }

    return $paymentService;
  }

  /**
   * @param User $user
   * @param $paymentGatewayType
   * @return \Doctrine\Common\Collections\ArrayCollection
   */
  public function getCustomerGatewayReference(User $user)
  {
    $paymentGatewayType = $this->getPaymentGatewayType();
    $customerReferences = $user->getCustomerPaymentGateways()->filter(function (CustomerPaymentGateway $customerPaymentGateway) use ($paymentGatewayType) {
      return $customerPaymentGateway->getType() === $paymentGatewayType;
    });

    return $customerReferences->first();
  }

  /**
   * @param User $user
   * @param $cardData ['exp_month' => '12', 'exp_year' => '2021', 'number' => '4111111111111111', 'cvc' => '123']
   * @param string $paymentGatewayType
   * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
   */
  public function registerPaymentMethod(User $user, $cardData)
  {
    $paymentService = $this->getPaymentServiceFactory();
    $paymentInfo = new PaymentInfo();
    $paymentInfo->setPaymentGateway($this->getPaymentGatewayType());
    $servicePaymentMethodData = $paymentService->registerPaymentMethodFrom3rdPaty($user, $cardData);

    if (!$servicePaymentMethodData['customer_ref']) {
      throw new \Exception('Cannot contact to payment gateway for creating customer!');
    }

    if (!$servicePaymentMethodData['payment_method_ref']) {
      throw new \Exception('Payment method cannot be created in payment gateway!');
    }

    if (!$servicePaymentMethodData['card_valid']) {
      throw new \Exception('Card is invalid!', 1000);
    }

    $paymentInfo->setCustomerRef($servicePaymentMethodData['customer_ref']);
    $paymentInfo->setPaymentMethodRef($servicePaymentMethodData['payment_method_ref']);
    $paymentInfo->setStatus($servicePaymentMethodData['card_valid'] ? PaymentUtil::SUCCESS : PaymentUtil::FAIL);

    $customerReference = $this->getCustomerGatewayReference($user);

    // create customer reference to store the ref from 3rd party payment gateway
    if (!$customerReference) {
      $customerReference = new CustomerPaymentGateway();
      $customerReference->setCustomerRef($paymentInfo->getCustomerRef());
      $customerReference->setStatus(PaymentUtil::SUCCESS);

      $customerReference->setType(PaymentUtil::STRIPE_GATEWAY_TYPE);
      $user->addCustomerPaymentGateway($customerReference);
    }

    //$cardData = $this->getContainer()->get(ServiceUtil::JWT_ENCODER_SERVICE)->encode($cardData);
    $paymentInfo->setCardInfo($cardData);

    // store the payment activity as history
    $paymentActivity = new PaymentActivity();
    $paymentActivity->setLog($servicePaymentMethodData['card_response']);
    $paymentInfo->addPaymentActivity($paymentActivity);
    $paymentInfo->setUser($user);

    $this->persistAndFlush($paymentInfo);
    $this->setPaymentInfo($paymentInfo);
    return $this;
  }

  public function decoratePaymentInfo() {
    $paymentInfo = $this->getPaymentInfo();

    if (!$paymentInfo) {
      throw new \Exception('Payment info is set!', 1000);
    }

    $cardInfo = $paymentInfo->getCardInfo();

    if (!$cardInfo) {
      throw new \Exception('Card info is missing!', 1000);
    }

    $cardInfo = [];// $this->getContainer()->get(ServiceUtil::JWT_ENCODER_SERVICE)->decode($cardInfo);
    $cardInfo['number'] = PaymentUtil::ccMasking($cardInfo['number']);
    $cardInfo['status'] = $paymentInfo->getStatus();

    return $cardInfo;
  }

  public function getListOfPaymentInfoOfUser(User $user) {
    $paymentInfos = $user->getPaymentInfos()->toArray();

    return array_map(function(PaymentInfo $paymentInfo) {
      $cardInfo = [];
      $cardInfo['id'] = $paymentInfo->getId();
      $cardInfo['name'] = 'Personal';
      $cardInfo['end_number'] = 'Card ending - 1111';
      $cardInfo['is_default'] = true;
      $cardInfo['status'] = 'VALID';
      return $cardInfo;
    }, $paymentInfos);
  }

  /**
   * @param User $user
   * @param $cardData
   * @param $amountData
   */
  public function pay($visitId, $paymentInfoId, $currency)
  {
    $transaction = new Transaction();
    $visit = $this->getRepository(Visit::class)->find($visitId);

    if (!$visit) {
      throw new \Exception('This visit is not found!', 1000);
    }

    $paymentInfo = $this->getRepository(PaymentInfo::class)->find($paymentInfoId);

    if (!$paymentInfo) {
      throw new \Exception('This payment info is not found!', 1000);
    }

    if ($paymentInfo->getStatus() != PaymentUtil::SUCCESS) {
      throw new \Exception('This payment info is invalid!', 1000);
    }

    $transaction->setVisit($visit);
    $transaction->setPaymentInfo($paymentInfo);
    $transaction->setStatus(PaymentUtil::PENDING);

    $transaction->setAmount(502.00); //TODO: mock here, implement after
    $transaction->setCurrency($currency);
    $this->persistAndFlush($transaction);

    $paymentService = $this->getPaymentServiceFactory();
    //$cardInfo = $this->getContainer()->get(ServiceUtil::JWT_ENCODER_SERVICE)->decode($paymentInfo->getCardInfo());

    if (!$cardInfo) {
      throw new \Exception('Card info is required!');
    }

    $amountData = [
      'amount' => $transaction->getAmount(),
      'currency' => $transaction->getCurrency()
    ];

    $cardInfo = PaymentUtil::sanitizeCCInformation($cardInfo);
    $paymentGatewayChargeResponse = $paymentService->pay($paymentInfo, $cardInfo, $amountData);
    $transactionActivity = new TransactionActivity();

    if (isset($paymentGatewayChargeResponse['error'])) {
      $transaction->setStatus(PaymentUtil::FAIL);
    } else {
      $transaction->setStatus(PaymentUtil::SUCCESS);
    }

    $transactionActivity->setLog(json_encode($paymentGatewayChargeResponse));
    $transaction->addTransactionActivity($transactionActivity);
    $transaction->setTransactionRef($paymentGatewayChargeResponse['transaction_ref']);
    $this->persistAndFlush($transaction);

    return $transaction;
  }
}
