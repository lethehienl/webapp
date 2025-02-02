<?php

namespace App\Bundle\AppBundle\Utils;


class FileUtil
{
  const AVATAR_FOLDER = 'avatar';
  const COMPANY_LOGO_FOLDER = 'company';
  const PROPERTY_IMAGES_FOLDER = 'property';

  public static function calculatePercent($used, $total)
  {
    if (empty($total)) {
      return 0;
    }

    if ($used > $total) {
      return 100;
    }

    $percent = ($used / $total) * 100;
    return number_format($percent, 2);
  }

  public static function getFilePath($filename, $domain = false)
  {
    if (!$filename || $filename == '') {
      $path = '/default/company-default.png';
    } else {
      $path = $filename;
    }

    if (!$domain) {
      return $path;
    }

    return $domain . $path;
  }
}