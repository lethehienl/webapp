<?php


namespace App\Bundle\AppBundle\Utils;


class MapUtil
{
  /**
   * Calculates the great-circle distance between two points, with
   * the Haversine formula.
   * @param float $latitudeFrom Latitude of start point in [deg decimal]
   * @param float $longitudeFrom Longitude of start point in [deg decimal]
   * @param float $latitudeTo Latitude of target point in [deg decimal]
   * @param float $longitudeTo Longitude of target point in [deg decimal]
   * @param float $earthRadius Mean earth radius in [m]
   * @return float Distance between points in [m] (same as earthRadius)
   */
  public static function haversineGreatCircleDistance(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
  {
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
  }

  public static function convertDistanceUnit($distance, $fromUnit = 'm', $toUnit = 'km') {
    $conversionRate = 1;

    if ($fromUnit == 'm' && $toUnit == 'km') {
      $conversionRate = 0.001;
    }

    if ($fromUnit == 'dm' & $toUnit == 'km') {
      $conversionRate = 0.0001;
    }

    if ($fromUnit == 'cm' & $toUnit == 'km') {
      $conversionRate = 0.00001;
    }

    if ($fromUnit == 'mm' & $toUnit == 'km') {
      $conversionRate = 0.000001;
    }

    return (round($distance * $conversionRate, 2)) . ' '. $toUnit;
  }
}