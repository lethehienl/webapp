<?php

namespace PaymentBundle\Services;

use AppBundle\Services\AbstractService;
use PaymentBundle\Entity\PaymentInfo;
use PaymentBundle\Utils\PaymentUtil;
use Stripe\Customer;
use UserBundle\Entity\CustomerPaymentGateway;
use UserBundle\Entity\User;

class StripeService extends AbstractService implements PaymentServiceClientInterface
{
  /**
   * @return object|\Stripe\StripeClient|null
   */
  public function getClient()
  {
    return $this->getContainer()->get('stripe.client');
  }

  /**
   * @param $email
   * @return Customer
   */
  public function createOrGetCustomer(User $user)
  {
    $customer = null;

    $userReferences = $user->getCustomerPaymentGateways()->filter(function(CustomerPaymentGateway $customerPaymentGateway) {
      return $customerPaymentGateway->getType() === PaymentUtil::STRIPE_GATEWAY_TYPE;
    });

    /**
     * @var CustomerPaymentGateway $userReference
     */
    $userReference = $userReferences->first();

    if (!$userReference) {
      return $this->getClient()->customers->create();
    }

    try {
      $customer = $this->getClient()->customers->retrieve($userReference->getCustomerRef());
    } catch (\Exception $ex) {

    }

    if (!$customer) {
      $customer = $this->getClient()->customers->create([
        'name' => $user->getFullName(),
        'email' => $user->getUsername()
      ]);
    }

    return $customer;
  }

  public function createPaymentIntent($paymentMethodId, $customerId, $amountData)
  {
    return $this->getClient()->paymentIntents->create([
      'amount' => $amountData['amount'],
      'currency' => $amountData['currency'],
      'payment_method_types' => ['card'],
      'payment_method' => $paymentMethodId,
      'customer' => $customerId,
      'confirm' => true
    ]);
  }

  /**
   * @param $card
   * @return Customer
   * @throws \Stripe\Exception\ApiErrorException
   */
  public function createPaymentMethod($card)
  {
    return $this->getClient()->paymentMethods->create([
      'type' => 'card',
      'card' => $card
    ]);
  }

  public function attachPaymentMethod($cardId, $customerId)
  {
    return $this->getClient()->paymentMethods->attach($cardId, [
      ['customer' => $customerId]
    ]);
  }

  public function registerPaymentMethodFrom3rdPaty(User $user, $cardData)
  {
    $result = [
      'customer_ref' => '',
      'payment_method_ref' => '',
      'card_valid' => false,
      'card_response' => ''
    ];

    try {
      $customer = $this->createOrGetCustomer($user);
      $result['customer_ref'] = $customer->id;

      $paymentMethod = $this->createPaymentMethod($cardData);
      $paymentMethod = $this->attachPaymentMethod($paymentMethod->id, $customer->id);
      $result['payment_method_ref'] = $paymentMethod->id;

      $stripeCard = $paymentMethod->card->toArray();
      $result['card_valid'] = $stripeCard['checks']['cvc_check'] === 'pass';
      $result['card_response'] = $paymentMethod->card->toJSON();
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());
      return $result;
    }

    return $result;
  }

  /**
   * @param PaymentInfo $paymentInfo
   * @param $amountData ['amount' => 100, 'currency' => 'usd']
   */
  public function pay(PaymentInfo $paymentInfo, $amountData)
  {
    try {
      $amountData['amount'] = ceil(PaymentUtil::LOCALE_CURRENCY_MULTIPLY[$amountData['currency']] * $amountData['amount']);

      $paymentIntent = $this->createPaymentIntent(
        $paymentInfo->getPaymentMethodRef(),
        $paymentInfo->getCustomerRef(),
        $amountData);
    } catch (\Exception $ex) {
      $this->writeLog($ex->getMessage());

      return [
        'transaction_ref' => null,
        'status' => 'Fail',
        'amount' => $amountData['amount'],
        'currency' => $amountData['currency'],
        'payment_method' => $paymentInfo->getPaymentMethodRef(),
        'customer' => $paymentInfo->getCustomerRef(),
        'cancel_reason' => $ex->getMessage(),
        'created_at' => new \DateTime()
      ];
    }

    return [
      'transaction_ref' => $paymentIntent->id,
      'status' => $paymentIntent->status,
      'amount' => $paymentIntent->amount,
      'currency' => $paymentIntent->currency,
      'payment_method' => $paymentIntent->payment_method,
      'customer' => $paymentIntent->customer,
      'cancel_reason' => $paymentIntent->cancellation_reason,
      'created_at' => $paymentIntent->created
    ];
  }
}