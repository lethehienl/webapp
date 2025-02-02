<?php

namespace AppBundle\Utils;

class MessageUtil
{
  const SUCCESS_KEY = 'success';
  const ERROR_KEY = 'error';
  const SUCCESS = 200;
  const FAIL = 400;

  public static function formatMessage($data = null, $code = 200, $message = 'Success')
  {
    $output = array('status' => array('code' => $code, 'message' => $message), 'data' => []);

    if (!empty($data)) {
      $output['data'] = $data;
    }

    return $output;
  }

  public static function defaultDataTableMessage()
  {
    $data = array(
      'draw' => 1,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => []
    );

    return $data;
  }

  public static function defaultChartMessage()
  {
    $data = array(
      "labels" => [
        "Thứ Hai",
        "Thứ Ba",
        "Thứ Tư",
        "Thứ Năm",
        "Thứ Sáu",
        "Thứ Bảy",
        "Chủ Nhật"
      ],
      "datasets" => [
        [
          "label" => "none",
          "fill" => false,
          "data" => [
            0,
            0,
            0,
            0,
            0,
            0,
            0,
          ],
          "backgroundColor" => "rgba(0,185,242,0.38)",
          "borderWidth" => 1,
          "hoverBorderWidth" => 3,
          "borderColor" => "#00b9f2"
        ]
      ]
    );

    return $data;
  }

  public static function getBusinessMessage(\Exception $ex)
  {
    $exCode = $ex->getCode();

    if ($exCode >= 1000) {
      return $ex->getMessage();
    }

    return 'Error detected. Please contact admin for support.';
  }

  public static function getExceptionJsonMessage(\Exception $ex)
  {
    return self::formatMessage(null, $ex->getCode(), self::getBusinessMessage($ex));
  }

  public static function formatFoMessageAdmin($code = 200, $message = 'Success', $data = null)
  {
    $output = array('code' => $code, 'message' => $message);

    if (!empty($data)) {
      $output['data'] = $data;
    }

    return $output;
  }

}