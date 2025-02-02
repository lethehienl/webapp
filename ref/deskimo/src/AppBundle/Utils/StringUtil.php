<?php

namespace AppBundle\Utils;


class StringUtil
{
  public static function generateHashToken(string $string)
  {
    $hashData = $string . time() . rand();

    return hash('sha256', $hashData);
  }

  public static function trimAllSpace($str)
  {
    return str_replace(' ','',$str);;
  }

  public static function generateRandomString($length = 8, $onlyNumber = false)
  {
    if ($onlyNumber) {
      $characters = '0123456789';
    } else {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }

    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return strtoupper($randomString);
  }

  public static function displayCode($code, $limit = 4)
  {
    if (empty($code)) {
      return $code;
    }

    $codes = explode('_', $code);

    if (count($codes) >= 2) {
      $code = $codes[1];
    }

    return chunk_split($code, $limit, ' ');
  }

  public static function setPropertyCode( $string = '')
  {
    $hashData = $string . time() . rand();

    return hash('sha256', $hashData);
  }

  public static function updateCode($prefix, $code)
  {
    return $prefix . '_' . $code;
  }
}