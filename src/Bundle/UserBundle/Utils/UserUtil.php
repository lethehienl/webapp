<?php

namespace App\Bundle\UserBundle\Utils;

use Cocur\Slugify\Slugify;
use UserBundle\Entity\User;

class UserUtil
{
  const USER_ACTIVE = 'Active';
  const USER_INACTIVE = 'In-active';

  const ACTIVE = 1;
  const INACTIVE = 0;

  const EN_LOCALE = 'en';
  const SG_LOCALE = 'sg';
  const VI_LOCALE = 'vi';

  const IS_UPDATED_PROFILE = 1;
  const IS_NEW_PROFILE = 0;

  const USER_STATUS_MAPPING = [
    self::INACTIVE => self::USER_INACTIVE,
    self::ACTIVE => self::USER_ACTIVE
  ];

  public static function buildUserNameDefault($string = 'N/A')
  {
    return md5(time() . rand()) . '@yopmail.com';
  }
}
