<?php

namespace AppBundle\Utils;


class StatusUtil
{
  const ACTIVE_CODE = 1;
  const INACTIVE_CODE = 0;

  const EDIT_MODE = 'edit';
  const CREATE_MODE = 'create';

  const STATUS_MAPPING = [
    self::ACTIVE_CODE => 'Active',
    self::INACTIVE_CODE => 'In-active',
  ];

  const STATUS_MAPPING_FORM = [
     'Active' => self::ACTIVE_CODE,
    'In-active' => self::INACTIVE_CODE,
  ];
}
