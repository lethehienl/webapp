<?php

namespace UserBundle\Controller\Api;

use AppBundle\Controller\NaviRestController;
use AppBundle\Utils\MessageUtil;
use AppBundle\Utils\ServiceUtil;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use UserBundle\Services\UserApiService;

class UserController extends NaviRestController
{
  /**
   * @Rest\Post(path="api/v1/otp", name="api_get_otp_code_route")
   */
  public function getOtpCodeAction(Request $request)
  {
    try {
      /** @var UserApiService $userService */
      $userService = $this->get(ServiceUtil::USER_API_SERVICE);
      $userService->generateOtpCode();
      $data = MessageUtil::formatMessage();
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Put(path="api/v1/user", name="api_update_user_route")
   */
  public function updateProfileAction(Request $request)
  {
    try {
      /** @var UserApiService $userService */
      $userService = $this->get(ServiceUtil::USER_API_SERVICE);
      $userService->updateProfile();
      $data = MessageUtil::formatMessage();
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Put(path="api/v1/user/update-avatar", name="api_upload_avatar_route")
   */
  public function uploadAvatarAction(Request $request)
  {
    try {
      /** @var UserApiService $userService */
      $userService = $this->get(ServiceUtil::USER_API_SERVICE);
      $userService->uploadAvatar();
      $data = MessageUtil::formatMessage();
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Get(path="api/v1/user", name="api_get_user_profile_route")
   */
  public function getUserProfileAction(Request $request)
  {
    try {
      /** @var UserApiService $userService */
      $userService = $this->get(ServiceUtil::USER_API_SERVICE);
      $userProfile = $userService->getUserProfile();
      $data = MessageUtil::formatMessage($userProfile);
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }

  /**
   * @Rest\Post (path="api/v1/device-token", name="api_register_device_token_route")
   */
  public function registerDeviceTokenAction(Request $request)
  {
    try {
      /** @var UserApiService $userService */
      $userService = $this->get(ServiceUtil::USER_API_SERVICE);
      $userService->registerDeviceToken();
      $data = MessageUtil::formatMessage();
    } catch (\Exception $ex) {
      $message = MessageUtil::getBusinessMessage($ex);
      $data = MessageUtil::formatMessage(null, $ex->getCode(), $message);
    }

    return $this->responseJson($data);
  }
}
