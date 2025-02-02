<?php

namespace App\Bundle\UserBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Services\SmsNotificationService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\PhoneUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StringUtil;
use UserBundle\Entity\DeviceToken;
use UserBundle\Entity\User;
use UserBundle\Utils\UserUtil;

class UserApiService extends AbstractService
{
  public function generateOtpCode()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['phone_number', 'country_code'];
    $this->validateRequireFields($postData, $requiredFields);

    $phoneNumber = $postData->phone_number;
    $conditions = ['phoneNumber' => $phoneNumber];
    $user = $this->getEntityByConditions(User::class, $conditions);

    if (empty($user)) {
      $user = new User();
      $user->setPhoneNumber($phoneNumber);
      $user->setPassword(StringUtil::generateHashToken($phoneNumber));
      $user->setUsername(UserUtil::buildUserNameDefault($phoneNumber));
      $user->setIsUpdateProfile(UserUtil::IS_NEW_PROFILE);
    }

    $user->setStatus(UserUtil::ACTIVE);
    $user->setCountryCode($postData->country_code);
    $user->setExpireOtpAt(DateTimeUtil::createExpiredTime());
    $user->setOtp(StringUtil::generateRandomString(4, true));

    $this->persist($user, true);

    /** @var SmsNotificationService $smsService */
    $smsService = $this->getService(ServiceUtil::SMS_NOTIFICATION_SERVICE);
    $phoneNumber = PhoneUtil::formatSMSPhone($user->getCountryCode(), $phoneNumber);
    $message = PhoneUtil::getMessage($user->getOtp());
    $smsService->setTo($phoneNumber)->setBody($message)->send();
  }

  public function updateProfile()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['full_name', 'email'];
    $this->validateRequireFields($postData, $requiredFields);

    $conditions = ['username' => $postData->email];
    /** @var User $userEmail */
    $userEmail = $this->getEntityByConditions(User::class, $conditions);
    $currentUser = $this->getLoggedUser();

    if (!empty($userEmail) && $userEmail->getId() != $currentUser->getId()) {
      $this->throwException('Field email is taken', 1001);
    }

    $currentUser->setUsername($postData->email);
    $currentUser->setFullName($postData->full_name);
    $currentUser->setIsUpdateProfile(UserUtil::IS_UPDATED_PROFILE);
    $this->persist($currentUser, true);
  }

  public function uploadAvatar()
  {

  }

  public function getUserProfile()
  {
    $user = $this->getLoggedUser();

    $userProfile = [
      'email' => $user->getUsername(),
      'full_name' => $user->getFullName(),
      'phone_number' => $user->getPhoneNumber(),
      'avatar' => '',
      'is_new' => $user->getIsUpdateProfile() == UserUtil::IS_NEW_PROFILE,
      'country_code' => $user->getCountryCode(),
    ];

    return $userProfile;
  }

  public function registerDeviceToken()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['device_token', 'from_os'];
    $this->validateRequireFields($postData, $requiredFields);

    $conditions = ['deviceToken' => $postData->device_token, 'fromOs' => $postData->from_os];
    $deviceToken = $this->getEntityByConditions(DeviceToken::class, $conditions);

    if (!empty($deviceToken)) {
      return;
    }

    $deviceToken = new DeviceToken();
    $deviceToken->setFromOs($postData->from_os);
    $deviceToken->setUser($this->getLoggedUser());
    $deviceToken->setDeviceToken($postData->device_token);

    $this->persist($deviceToken, true);
  }

  public function logout()
  {
    //TODO remove accesstoken
    //Remove register device token
  }
}
