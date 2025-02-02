<?php


namespace PaymentBundle\Services;


use PaymentBundle\Entity\PaymentInfo;
use UserBundle\Entity\User;

interface PaymentServiceClientInterface
{
  public function getClient();

  public function registerPaymentMethodFrom3rdPaty(User $user, $cardData);

  public function pay(PaymentInfo $paymentInfo, $amountData);
}