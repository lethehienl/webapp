<?php

namespace VisitBundle\Utils;

class VisitUtil
{
  const REQUEST_PENDING_STATUS = 0;
  const REQUEST_ACCEPTED_STATUS = 1;
  const REQUEST_EXPIRED_STATUS = 2;

  const VISIT_ON_GOING_STATUS = 0;
  const VISIT_FINISHED_STATUS = 1;
  const VISIT_FINISH_PAYMENT_STATUS = 2;

  const RE_ENTER_PENDING_STATUS = 0;
  const RE_ENTER_ACCEPTED_STATUS = 1;
  const RE_ENTER_EXPIRED_STATUS = 2;

  const VISIT_ON_GOING_TEXT = 'Ongoing';
  const VISIT_ON_FINISHED_TEXT = 'Awaiting Payment';
  const VISIT_FINISH_PAYMENT_TEXT = 'Complete';

  const VISIT_REVIEWED = 1;
  const VISIT_WAITING_REVIEW = 0;

  const VISIT_STATUS_TEXT = [
    self::REQUEST_PENDING_STATUS => self::VISIT_ON_GOING_TEXT,
    self::VISIT_FINISHED_STATUS => self::VISIT_ON_FINISHED_TEXT,
    self::VISIT_FINISH_PAYMENT_STATUS => self::VISIT_FINISH_PAYMENT_TEXT
  ];

  public static function getVisitStatus($visitStatusId)
  {
    return isset(self::VISIT_STATUS_TEXT[$visitStatusId]) ? self::VISIT_STATUS_TEXT[$visitStatusId] : 'N/A';
  }
}
