<?php

namespace PaymentBundle\Utils;

use UserBundle\Utils\UserUtil;

class PaymentUtil
{
  const STRIPE_GATEWAY_TYPE = 'stripe';

  const EN_CURRENCY = 'usd';
  const SG_CURRENCY = 'sgd';
  const VI_CURRENCY = 'vnd';

  const LOCALE_CURRENCY_MAPPING = [
    UserUtil::EN_LOCALE => self::EN_CURRENCY,
    UserUtil::SG_LOCALE => self::SG_CURRENCY,
    UserUtil::VI_LOCALE => self::VI_CURRENCY
  ];

  const LOCALE_CURRENCY_MULTIPLY = [
    self::EN_CURRENCY => 100,
    self::SG_CURRENCY => 100,
    self::VI_CURRENCY => 1
  ];

  const PENDING = 0;
  const FAIL = 1;
  const SUCCESS = 2;

  /**
   * @param $rawRequest
   * [
   *  'full_name' => '',
   *  'credit_number' => '',
   *  'expired_date' => '',
   *  'cvv_number' => ''
   * ]
   */
  public static function transformCreatePaymentInfoRequestPayload($rawRequest)
  {
    $expiredDate = $rawRequest['expired_date'];
    $expiredDateArr = explode('/', $expiredDate);

    return [
      'exp_month' => trim(@$expiredDateArr['0']),
      'exp_year' => trim(@$expiredDateArr['1']),
      'number' => trim(@$rawRequest['credit_number']),
      'cvc' => trim(@$rawRequest['cvc_number'])
    ];
  }

  public static function ccMasking($number, $maskingCharacter = 'X')
  {
    return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
  }

  public static function sanitizeCCInformation($cardData)
  {
    return [
      'exp_month' => $cardData['exp_month'],
      'exp_year' => $cardData['exp_year'],
      'number' => $cardData['number'],
      'cvc' => $cardData['cvc']
    ];
  }

  public static function createDetailPaymentReview($detailUrl, $paymentId)
  {
    if (empty($paymentId)) {
      return '';
    }

    return $detailUrl . $paymentId;
  }
}
