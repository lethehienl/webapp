<?php

namespace UserBundle\Utils;

class LandingPageUtil
{
  const CAMPAIGN_M_A_SLUG = 'email-accouncement-april-2020';
  const CAMPAIGN_INTRODUCTION_SLUG = 'trial-account-april-2020';

  const CRM_HOME_PAGE_FORM_KEY = 'p0ClqX56bEbl9c2sjTnwfkBuDkAbHSIpIu6fIzSIVYMpdTJXA9';
  const CRM_HOME_PAGE_FORM_TOKEN = 'ErgI0uUX9g';

  const CRM_CAMPAIGN_M_A_KEY = 'yAyrMNZMoHrIKUavCf5roa082jIyGF9rAUrG52OZS99KxafWw1';
  const CRM_CAMPAIGN_M_A_TOKEN = 'Dt066p05E6';

  const CRM_CAMPAIGN_INTRODUCTION_KEY = 'qKRd30JzMlODitVQxncc7EB95gh8YL2DGtMmP9QPQ4d8HwnVbZ';
  const CRM_CAMPAIGN_INTRODUCTION_TOKEN = 'KND0RcE5iV';

  const CAMPAIGN_MAPPING = [
    self::CAMPAIGN_M_A_SLUG => [
      'template' => 'landingPage1.html.twig',
      'getfly_crm_key' => self::CRM_CAMPAIGN_M_A_KEY,
      'getfly_crm_token' => self::CRM_CAMPAIGN_M_A_TOKEN
    ],

    self::CAMPAIGN_INTRODUCTION_SLUG => [
      'template' => 'landingPage2.html.twig',
      'getfly_crm_key' => self::CRM_CAMPAIGN_INTRODUCTION_KEY,
      'getfly_crm_token' => self::CRM_CAMPAIGN_INTRODUCTION_TOKEN
    ],
  ];

  public static function getPageInfo($slug = null)
  {
    $defaultValue = ['getfly_crm_key' => self::CRM_HOME_PAGE_FORM_KEY, 'getfly_crm_token' => self::CRM_HOME_PAGE_FORM_TOKEN, 'template' => ''];

    if (empty($slug) || !isset(self::CAMPAIGN_MAPPING[$slug])) {
      return $defaultValue;
    }

    return self::CAMPAIGN_MAPPING[$slug];
  }
}
