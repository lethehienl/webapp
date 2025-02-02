<?php

namespace AppBundle\Utils;

class ServiceUtil
{
  const ORDER_SERVICE = 'order.service';
  const USER_SERVICE = 'user.service';
  const LOGGER_SERVICE = 'logger';
  const PHOTO_UPLOADER_SERVICE = 'photo_upload.service';

  const PROPERTY_SERVICE = 'property.service';
  const PROPERTY_CATEGORY_SERVICE = 'property_category.service';
  const PROPERTY_LOCATION_SERVICE = 'property_location.service';
  const PROPERTY_BENEFIT_SERVICE = 'property_benefit.service';
  const PROPERTY_COMPANY_SERVICE = 'property_company.service';

  const PASSWORD_ENCODER_SERVICE = 'security.password_encoder';
  const STRIPE_SERVICE = 'stripe.service';
  const JWT_ENCODER_SERVICE = 'lexik_jwt_authentication.encoder';
  const PAYMENT_METHOD_SERVICE = 'payment_method.service';

  const USER_API_SERVICE = 'user_api.service';
  const VISIT_API_SERVICE = 'visit_api.service';
  const VISIT_SERVICE = 'visit.service';
  const PROPERTY_API_SERVICE = 'property_api.service';
  const TRANSACTION_API_SERVICE = 'transaction_api.service';
  const SMS_NOTIFICATION_SERVICE = 'sms_notification.service';
  const EMAIL_NOTIFICATION_SERVICE = 'email_notification.service';
  const STATISTIC_SERVICE = 'statistic.service';
  const ABSTRACT_SERVICE = 'abstract.service';
  const SEARCH_SERVICE = 'property_search.service';
  const INVOICE_SERVICE = 'invoice.service';
}
