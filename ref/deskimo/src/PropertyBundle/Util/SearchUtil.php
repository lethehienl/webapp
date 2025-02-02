<?php


namespace PropertyBundle\Util;


class SearchUtil
{
  const LATEST_SORT_TYPE = 0;
  const NEAREST_SORT_TYPE = 1;
  const LOWER_PRICE_SORT_TYPE = 2;
  const HIGHER_PRICE_SORT_TYPE = 3;

  const SORT_MAPPING = [
    self::LATEST_SORT_TYPE => [
      'field' => 'updatedAt',
      'order' => 'desc',
    ],
    self::NEAREST_SORT_TYPE => [
      'field' => '_geo_distance',
      'order' => 'asc',
      'unit' => 'km'
    ],
    self::LOWER_PRICE_SORT_TYPE => [
      'field' => 'ratePerHour',
      'order' => 'desc'
    ],
    self::HIGHER_PRICE_SORT_TYPE => [
      'field' => 'ratePerHour',
      'order' => 'asc'
    ],
  ];
}