<?php

namespace App\Bundle\AppBundle\Utils;

class PriceUtil
{
  public static function calculatePrice(\DateTime $fromDate, \DateTime $toDate, $ratePerHour)
  {
    $distanceTime = round(abs($toDate->getTimestamp() - $fromDate->getTimestamp()), 1);
    $hour = $distanceTime / 60;

    return round($hour * $ratePerHour, 2);
  }
}