<?php

namespace AppBundle\Utils;

class DateTimeUtil
{
  const DATE_FORMAT = 'd/m/Y';
  const DATETIME_FORMAT = 'd/m/Y h:i A';
  const GM_DATETIME_FORMAT = 'Y-m-d\TH:i:s\Z';
  const CLIENT_FORMAT_DATEPICKER = '';

  const MDY_FORMAT = 'm/d/Y';
  const YMD_FORMAT = 'Y-m-d';
  const TIME_FORMAT = 'h:i A';
  const MYSQL_FORMAT = 'Y-m-d H:i:s';

  const ONE_DAY_SECONDS = 86400;
  const ONE_YEAR_SECONDS = self::ONE_DAY_SECONDS * 356;

  public static function formatDate(\DateTime $dateTime, $format = self::DATETIME_FORMAT)
  {
    if (empty($dateTime)) {
      return 'N/A';
    }

    return $dateTime->format($format);
  }

  public static function convertDateFormat($strDate, $fromFormat, $toFormat)
  {
    if (empty($strDate)) {
      return '';
    }

    $date = \DateTime::createFromFormat($fromFormat, $strDate);

    if (empty($date)) {
      return '';
    }

    return $date->format($toFormat);
  }

  public static function createDateFromStr($strDate, $format = self::MDY_FORMAT, $withoutTime = false)
  {
    $format = $withoutTime ? '!' . $format : $format;
    return \DateTime::createFromFormat($format, $strDate);
  }

  public static function getCurrentTimestamp()
  {
    $now = new \DateTime();
    return $now->getTimestamp();
  }

  public static function getDistanceTime(\DateTime $fromDate, \DateTime $toDate)
  {
    if ($fromDate >= $toDate) {
      return 0;
    }

    return round(abs($toDate->getTimestamp() - $fromDate->getTimestamp()), 1) / 60;
  }

  public static function mappingDateInWeek()
  {
    return [
      "Mon" => "Thứ Hai",
      "Tue" => "Thứ Ba",
      "Wed" => "Thứ Tư",
      "Thu" => "Thứ Năm",
      "Fri" => "Thứ Sáu",
      "Sat" => "Thứ Bảy",
      "Sun" => "Chủ Nhật",
    ];
  }

  public static function getDayFromDate($date)
  {
    return date('D', strtotime($date));
  }

  public static function getDayFromDateVi($date)
  {
    return self::mappingDateInWeek()[date('D', strtotime($date))];
  }

  public static function getStartAndEndDateOfMonth(&$start_date, &$end_date, $date = null)
  {
    $date = empty($date) ? date('Y-m-d H:i:s') : $date;
    $ts = strtotime($date);
    $date = date('Y-m', $ts);
    $start_date = $date . '-01';
    $end_date = date('Y-m-t', $ts);
  }

  public static function getStartAndEndDateOfWeek(&$start_date, &$end_date, $date = null)
  {
    $date = empty($date) ? date('Y-m-d H:i:s') : $date;

    $start_date = (date('D', strtotime($date)) == 'Mon') ? strtotime($date) : strtotime('last monday', strtotime($date));
    $end_date = strtotime('next sunday', $start_date);
  }

  public static function getBack4WeekFromThisDate(&$start_date, &$end_date, $date = null)
  {
    $date = empty($date) ? date('Y-m-d H:i:s') : $date;
    $startCurrentWeek = (date('D', strtotime($date)) == 'Mon') ? strtotime($date) : strtotime('last monday', strtotime($date));

    $end_date = date('Y-m-d', strtotime('next sunday', $startCurrentWeek));
    $start_date = date('Y-m-d', strtotime("-4 week", $startCurrentWeek));
  }

  public static function getBackNDateFromThisDate(&$start_date, &$end_date, $date = null, $n = 6)
  {
    $date = empty($date) ? date('Y-m-d H:i:s') : $date;
    $start_date = date('Y-m-d', strtotime("-" . $n . " day", strtotime($date)));
    $end_date = $date;
  }

  public static function getAllDateInRange($start_date, $end_date)
  {
    $allDateInRangeObj = new \DatePeriod(
      new \DateTime($start_date),
      new \DateInterval('P1D'),
      new \DateTime($end_date)
    );

    $allDateInRange = [];
    foreach ($allDateInRangeObj as $date) {
      $allDateInRange[] = $date->format('Y-m-d');
    }
    if (!in_array(date('Y-m-d', strtotime($end_date)), $allDateInRange)) {
      $allDateInRange[] = date('Y-m-d', strtotime($end_date));
    }

    return $allDateInRange;
  }

  public static function timeAgo($ago, $full = false)
  {
    $now = new \DateTime();
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
      'y' => 'năm',
      'm' => 'tháng',
      'w' => 'tuần',
      'd' => 'ngày',
      'h' => 'giờ',
      'i' => 'phút',
      's' => 'giây',
    );
    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
      } else {
        unset($string[$k]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'gần đây';
  }

  public static function formatDuration($seconds, $isFull = false)
  {
    if (empty($seconds)) {
      return '00:00:00';
    }

    // extract hours
    $hours = floor($seconds / (60 * 60));

    // extract minutes
    $divisor_for_minutes = $seconds % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);

    $str = sprintf("%02d Hour(s) %02d Minute(s)", $hours, $minutes);

    if ($isFull) {
      $divisor_for_seconds = $divisor_for_minutes % 60;
      $seconds = ceil($divisor_for_seconds);
      $str = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    return $str;
  }

  public static function createExpiredTime($minutes = 5)
  {
    $currentDate = new \DateTime();
    $currentDate->modify('+ ' . $minutes . ' minutes');

    return $currentDate;
  }

  public static function getDateAgoFromNow(\DateTime $date, $day = 30)
  {
    $date->modify('- ' . $day . ' days');
    return $date;
  }
}
