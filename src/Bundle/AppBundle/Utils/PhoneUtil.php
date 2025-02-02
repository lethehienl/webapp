<?php

namespace App\Bundle\AppBundle\Utils;

class PhoneUtil
{
  const VIETNAM_CODE = '84';
  const SINGAPORE_CODE = '22';

  const OTP_CODE_REGISTER_MESSAGE = 'OTP_CODE';

  const SMS_MESSAGE = [
    self::OTP_CODE_REGISTER_MESSAGE => 'Your Otp code'
  ];

  const PREFIX_PHONENUMBERS = [
    self::VIETNAM_CODE => ['0'],
    self::SINGAPORE_CODE => []
  ];

  public static function formatSMSPhone($countryCode, $phoneNumber)
  {
    $prefixPhoneNumber = substr($phoneNumber, 0, 1);

    if (isset(self::PREFIX_PHONENUMBERS[$countryCode][$prefixPhoneNumber])) {
      $phoneNumber = substr($phoneNumber, 1, strlen($phoneNumber));
    }

    return '+' . $countryCode . $phoneNumber;
  }

  public static function getMessage($otpCode, $type = self::OTP_CODE_REGISTER_MESSAGE)
  {
    return self::SMS_MESSAGE[$type] . ':' . $otpCode;
  }

  public static function displayPhoneNumber($originPhoneNumber)
  {
    $phoneNumber = '';

    if (empty($originPhoneNumber)) {
      return $phoneNumber;
    }

    $length = strlen($originPhoneNumber);
    $index = 0;

    for(; $index < $length; $index++) {
      $tmpChar = $originPhoneNumber[$index];

      if ($index >= 4 and $index <= 8) {
        $tmpChar = '*';
      }

      $phoneNumber .= $tmpChar;
    }

    return $phoneNumber;
  }
}