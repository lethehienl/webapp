<?php

namespace App\Bundle\AppBundle\Utils;

class PagingUtil
{
  const DEFAULT_ITEM_PER_PAGE = 12;

  public static function getOffset($page, $itemPerPage)
  {
    $page = ($page > 0) ? ($page - 1) : $page;
    $offset = $page * $itemPerPage;

    return $offset;
  }
}
