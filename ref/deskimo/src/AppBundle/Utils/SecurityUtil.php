<?php

namespace AppBundle\Utils;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;


class SecurityUtil
{
  const EXPIRED_TIME = 21600; //6 hours

  static function encrypt($string, $key)
  {
    $result = '';

    for ($i = 1; $i <= strlen($string); $i++) {
      $char = substr($string, $i - 1, 1);
      $keychar = substr($key, ($i % strlen($key)) - 1, 1);
      $char = chr(ord($char) + ord($keychar));
      $result .= $char;
    }

    return base64_encode($result);
  }

  static function decrypt($string, $key)
  {
    $string = base64_decode($string);
    $result = '';

    for ($i = 1; $i <= strlen($string); $i++) {
      $char = substr($string, $i - 1, 1);
      $keychar = substr($key, ($i % strlen($key)) - 1, 1);
      $char = chr(ord($char) - ord($keychar));
      $result .= $char;
    }
    return $result;
  }

  static function isEmailValid($email)
  {
    $emailConstraint = new Assert\Email();
    $validator = Validation::createValidator();

    $errors = $validator->validate(
      $email,
      $emailConstraint
    );

    if (count($errors) > 0) {
      return false;
    }

    return true;
  }
}
