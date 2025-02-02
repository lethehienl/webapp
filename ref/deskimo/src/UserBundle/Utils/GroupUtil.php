<?php

namespace UserBundle\Utils;

class GroupUtil
{
  const GROUP_ACTIVE = 'Active';
  const GROUP_INACTIVE = 'InActive';

  const ACTIVE = 1;
  const INACTIVE = 0;

  const COMPANY_GENERAL_LEADER = 'company-general-leader';
  const COMPANY_GROUP_GUEST_NAME = 'Company Guest Group';

  const GROUP_STATUS_MAPPING = [
    self::INACTIVE => self::GROUP_INACTIVE,
    self::ACTIVE => self::GROUP_ACTIVE
  ];
}
