<?php


namespace App\Bundle\AppBundle\Utils;


class RequestUtil
{
  public static function validatePayloadFieldMandatory($payload, $validateFields = []) {
    if (!$payload) {
      throw new \Exception('Payload is empty!', 1000);
    }

    foreach ($validateFields as $field) {
      if (!isset($payload[$field]) || empty($payload[$field])) {
        throw new \Exception($field . ' is required', 1000);
      }
    }
  }
}
