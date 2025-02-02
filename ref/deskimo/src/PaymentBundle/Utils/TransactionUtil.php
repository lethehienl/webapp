<?php

namespace PaymentBundle\Utils;

use UserBundle\Utils\UserUtil;

class TransactionUtil
{
  const REQUEST_STATUS_PENDING = 0;
  const REQUEST_STATUS_ACCEPTED = 1;

  const SUCCESS = 1;
  const PENDING = 0;
  const FAIL = 2;

  const CHECKIN_TYPE = 1;
  const RE_ENTER_TYPE = 2;
  const PAYMENT_TYPE = 3;
}
