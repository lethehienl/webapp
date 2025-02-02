<?php

namespace App\Bundle\AppBundle\Utils;


use Doctrine\Common\Collections\ArrayCollection;

class ArrayUtil
{
  /**
   * @param ArrayCollection[] $arrayCollections
   *
   * @return ArrayCollection
   */
  public static function merge(...$arrayCollections)
  {
    $listCollections = [];
    foreach ($arrayCollections as $arrayCollection) {
      $listCollections = array_merge($listCollections, $arrayCollection->toArray());
    }

    return new ArrayCollection(array_unique($listCollections, SORT_REGULAR));
  }

  public static function aasort(&$array, $key)
  {
    $sorter = array();
    $ret = array();
    reset($array);

    foreach ($array as $ii => $va) {
      $sorter[$ii] = $va[$key];
    }

    asort($sorter);

    foreach ($sorter as $ii => $va) {
      $ret[$ii] = $array[$ii];
    }

    $array = $ret;
  }
}