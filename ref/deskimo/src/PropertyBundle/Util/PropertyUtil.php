<?php

namespace PropertyBundle\Util;

class PropertyUtil
{
  const ACTIVE_STATUS = 1;
  const IN_ACTIVE_STATUS = 0;
  const IS_OPENED = 1;
  const IS_CLOSED = 0;
  const MAX_PICTURES = 6;

  const PROPERTY_PATH = '/media/property';

  const PROPERTY_STATUS_ACTIVE_CODE = 1;
  const PROPERTY_STATUS_NOT_ACTIVE_CODE = 2;
  const PROPERTY_STATUS_BOOK_CODE = 3;


  const PROPERTY_STATUS_ACTIVE_TEXT = 'Active';
  const PROPERTY_STATUS_NOT_ACTIVE_TEXT = 'Not Active';
  const PROPERTY_STATUS_BOOK_TEXT = 'Booked';


  const PROPERTY_STATUS = array(
    self::PROPERTY_STATUS_ACTIVE_CODE => self::PROPERTY_STATUS_ACTIVE_TEXT,
    self::PROPERTY_STATUS_NOT_ACTIVE_CODE => self::PROPERTY_STATUS_NOT_ACTIVE_TEXT,
    self::PROPERTY_STATUS_BOOK_CODE => self::PROPERTY_STATUS_BOOK_TEXT

  );

  const PROPERTY_STATUS_FORM = array(
    self::PROPERTY_STATUS_ACTIVE_TEXT => self::PROPERTY_STATUS_ACTIVE_CODE,
    self::PROPERTY_STATUS_NOT_ACTIVE_TEXT => self::PROPERTY_STATUS_NOT_ACTIVE_CODE,
    self::PROPERTY_STATUS_BOOK_TEXT => self::PROPERTY_STATUS_BOOK_CODE
  );

  #SEAT TYPE

  const PROPERTY_SEAT_TYPE_ONE_CODE = 1;
  const PROPERTY_SEAT_TYPE_TWO_CODE = 2;
  const PROPERTY_SEAT_TYPE_THREE_CODE = 3;
  const PROPERTY_SEAT_TYPE_FOUR_CODE = 4;
  const PROPERTY_SEAT_TYPE_FEW_CODE = 5;
  const PROPERTY_SEAT_TYPE_MANY_CODE = 6;
  const PROPERTY_SEAT_TYPE_FULL_CODE = 7;


  const PROPERTY_SEAT_TYPE_ONE_TEXT = "One seat";
  const PROPERTY_SEAT_TYPE_TWO_TEXT = "Two seats";
  const PROPERTY_SEAT_TYPE_THREE_TEXT = "Three seats";
  const PROPERTY_SEAT_TYPE_FOUR_TEXT = "Four seats";
  const PROPERTY_SEAT_TYPE_FEW_TEXT = "Few seats";
  const PROPERTY_SEAT_TYPE_MANY_TEXT = "Many seats";
  const PROPERTY_SEAT_TYPE_FULL_TEXT = "Full";


  const PROPERTY_SEAT_TYPE = array(
    self::PROPERTY_SEAT_TYPE_ONE_CODE => self::PROPERTY_SEAT_TYPE_ONE_TEXT,
    self::PROPERTY_SEAT_TYPE_TWO_CODE => self::PROPERTY_SEAT_TYPE_TWO_TEXT,
    self::PROPERTY_SEAT_TYPE_THREE_CODE => self::PROPERTY_SEAT_TYPE_THREE_TEXT,
    self::PROPERTY_SEAT_TYPE_FOUR_CODE => self::PROPERTY_SEAT_TYPE_FOUR_TEXT,
    self::PROPERTY_SEAT_TYPE_FEW_CODE => self::PROPERTY_SEAT_TYPE_FEW_TEXT,
    self::PROPERTY_SEAT_TYPE_MANY_CODE => self::PROPERTY_SEAT_TYPE_MANY_TEXT,
    self::PROPERTY_SEAT_TYPE_FULL_CODE => self::PROPERTY_STATUS_BOOK_TEXT

  );

  const PROPERTY_SEAT_TYPE_FORM = array(
    self::PROPERTY_SEAT_TYPE_ONE_TEXT => self::PROPERTY_SEAT_TYPE_ONE_CODE,
    self::PROPERTY_SEAT_TYPE_TWO_TEXT => self::PROPERTY_SEAT_TYPE_TWO_CODE,
    self::PROPERTY_SEAT_TYPE_THREE_TEXT => self::PROPERTY_SEAT_TYPE_THREE_CODE,
    self::PROPERTY_SEAT_TYPE_FOUR_TEXT => self::PROPERTY_SEAT_TYPE_FEW_CODE,
    self::PROPERTY_SEAT_TYPE_FEW_TEXT => self::PROPERTY_SEAT_TYPE_THREE_CODE,
    self::PROPERTY_SEAT_TYPE_MANY_TEXT => self::PROPERTY_SEAT_TYPE_MANY_CODE,
    self::PROPERTY_SEAT_TYPE_FULL_TEXT => self::PROPERTY_SEAT_TYPE_FULL_CODE
  );

  /*UNIT CONSTANT*/
  const PROPERTY_UNIT_MINUTE_CODE = 'min';
  const PROPERTY_UNIT_HOUR_CODE = 'hr';


  const PROPERTY_UNIT_MINUTE_TEXT = "Minute(s)";
  const PROPERTY_UNIT_HOUR_TEXT = 'Hour';

  const PROPERTY_UNIT = array(
    self::PROPERTY_UNIT_MINUTE_CODE => self::PROPERTY_UNIT_MINUTE_TEXT,
    self::PROPERTY_UNIT_HOUR_CODE => self::PROPERTY_UNIT_HOUR_TEXT,
  );

  const PROPERTY_UNIT_FORM = array(
    self::PROPERTY_UNIT_MINUTE_TEXT => self::PROPERTY_UNIT_MINUTE_CODE,
    self::PROPERTY_UNIT_HOUR_TEXT => self::PROPERTY_UNIT_HOUR_CODE,
  );

  const AMENIIY_FREE_STATUS_YES_CODE = 1;
  const AMENIIY_FREE_STATUS_NO_CODE = 2;

  const AMENIIY_FREE_STATUS_YES_TEXT = 'Yes';
  const AMENIIY_FREE_STATUS_NO_TEXT = 'No';

  const AMENIIY_FREE_STATUS = array(
    self::AMENIIY_FREE_STATUS_YES_CODE => self::AMENIIY_FREE_STATUS_YES_TEXT,
    self::AMENIIY_FREE_STATUS_NO_CODE => self::AMENIIY_FREE_STATUS_NO_TEXT,
  );

  const AMENIIY_FREE_STATUS_FORM = array(
    self::AMENIIY_FREE_STATUS_YES_TEXT => self::AMENIIY_FREE_STATUS_YES_CODE,
    self::AMENIIY_FREE_STATUS_NO_TEXT => self::AMENIIY_FREE_STATUS_NO_CODE,
  );

  const PROPERTY_IS_OPEN = 1;
  const PROPERTY_IS_CLOSED = 0;

  const CURRENCY_SINGAPORE_CODE = 'SGD';
  const CURRENCY_SINGAPORE_TEXT = 'SGD';
  const CURRENCY_SINGAPORE = array(
    self::CURRENCY_SINGAPORE_CODE => self::CURRENCY_SINGAPORE_TEXT,
  );
  const CURRENCY_SINGAPORE_FORM = array(
    self::CURRENCY_SINGAPORE_TEXT => self::CURRENCY_SINGAPORE_CODE,
  );

  const COUNTRY_SINGAPORE_CODE = '65';
  const COUNTRY_SINGAPORE_TEXT = 'Singapore';

  const COUNTRY = array(
    self::COUNTRY_SINGAPORE_CODE => self::COUNTRY_SINGAPORE_TEXT,
  );

  const COUNTRY_FORM = array(
    self::COUNTRY_SINGAPORE_TEXT => self::COUNTRY_SINGAPORE_CODE,
  );

  const TYPE_DEFAULT = 'Coworking';

  const TYPE_MAPPING = [
    1 => self::TYPE_DEFAULT,
  ];

  const WEEKDAY = array(
    'scheduleMonOpen' => "Monday",
    'scheduleTueOpen' => "Tuesday",
    'scheduleWed Open' => "Wednesday",

  );

  const PROPERTY_MIN_CHARGE = 1;
}
