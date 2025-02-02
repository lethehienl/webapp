<?php


namespace AppBundle\Security\Oauth;

use AppBundle\Utils\ServiceUtil;
use FOS\OAuthServerBundle\Storage\GrantExtensionInterface;
use OAuth2\Model\IOAuth2Client;
use Psr\Container\ContainerInterface;
use UserBundle\Entity\User;
use UserBundle\Services\UserService;
use UserBundle\Utils\UserUtil;

class OtpGrantExtension implements GrantExtensionInterface
{
  private $container;
  /**
   * OtpGrantExtension constructor.
   */
  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function checkGrantExtension(IOAuth2Client $client, array $inputData, array $authHeaders)
  {
    try {
      if (!isset($inputData['otp']) || !isset($inputData['phone_number'])) {
        return false;
      }

      $phoneNumber = $inputData['phone_number'];
      /** @var UserService $userService */
      $userService = $this->container->get(ServiceUtil::USER_SERVICE);
      $conditions = ['phoneNumber' => $phoneNumber, 'otp' => $inputData['otp'], 'status' => UserUtil::ACTIVE];

      /** @var User $user */
      $user = $userService->getEntityByConditions(User::class, $conditions);

      if (empty($user)) {
        return false;
      }

      $currentTime = new \DateTime();

      if ($currentTime > $user->getExpireOtpAt()) {
        return false;
      }

      return ['data' => $user];
    } catch (\Exception $ex) {
      return false;
    }
  }
}