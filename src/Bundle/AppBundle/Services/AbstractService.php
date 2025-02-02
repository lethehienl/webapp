<?php

namespace App\Bundle\AppBundle\Services;

use AppBundle\Utils\LoggerUtil;
use AppBundle\Utils\ServiceUtil;
use CompanyBundle\Services\PropertyCompanyService;
use CompanyBundle\Utils\PropertyCompanyUtil;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use UserBundle\Utils\UserUtil;

class AbstractService
{
  private $request;
  private $entityManager;
  private $container;
  private $tokenStorage;
  private $logger;
  protected $router;
  private $dispatcher;
  protected $authorizationChecker;

  /**
   * AppService constructor.
   */
  public function __construct(
    EntityManagerInterface $entityManager,
    RequestStack $requestStack,
    ContainerInterface $container,
    TokenStorageInterface $tokenStorage,
    LoggerInterface $logger,
    UrlGeneratorInterface $router,
    EventDispatcherInterface $dispatcher,
    AuthorizationCheckerInterface $authorizationChecker
  )
  {
    $this->logger = $logger;
    $this->router = $router;

    $this->container = $container;
    $this->dispatcher = $dispatcher;

    $this->tokenStorage = $tokenStorage;
    $this->entityManager = $entityManager;
    $this->request = $requestStack->getCurrentRequest();
    $this->authorizationChecker = $authorizationChecker;
  }

  public function getDispatcher()
  {
    return $this->dispatcher;
  }

  public function getEntityManager()
  {
    return $this->entityManager;
  }

  public function getRequest()
  {
    return $this->request;
  }

  public function getContainer()
  {
    return $this->container;
  }

  public function getLoggedUser()
  {
    $token = $this->tokenStorage->getToken();

    if (!$token) {
      return null;
    }

    /** @var User $user */
    $user = $token->getUser();
    return $user;
  }

  public function getService($serviceName)
  {
    return $this->getContainer()->get($serviceName);
  }

  public function getRepository($objClass)
  {
    return $this->getEntityManager()->getRepository($objClass);
  }

  public function writeLog($message, $level = LoggerUtil::ERROR_LEVEL)
  {
    switch ($level) {
      case LoggerUtil::ERROR_LEVEL:
        $this->logger->$level(__FUNCTION__ . '|' . $message);
        return;
      default:
        $this->logger->$level($message);
        return;
    }
  }

  public function mergeEntity($baseEntity, $newEntity)
  {
    $serializer = $this->getContainer()->get('jms_serializer');
    $merger = new EntityMerger(null, $serializer);
    $merger->merge($baseEntity, $newEntity);

    return $baseEntity;
  }

  public function getRoute()
  {
    return $this->router;
  }

  public function persist($object, $flush = false)
  {
    $this->getEntityManager()->persist($object);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function persistAndFlush($object)
  {
    $this->persist($object);
    $this->flush();
  }

  public function mergeAndFlush($object)
  {
    $this->merge($object);
    $this->flush();
  }

  public function remove($object)
  {
    $this->getEntityManager()->remove($object);
  }

  public function removeAndFlush($object)
  {
    $this->remove($object);
    $this->flush();
  }

  public function refreshEntity($object)
  {
    return $this->getEntityManager()->refresh($object);
  }

  public function merge($object)
  {
    $this->getEntityManager()->merge($object);
  }

  public function flush()
  {
    try {
      $this->getEntityManager()->flush();
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . '|' . $ex->getMessage());
      throw new \Exception('Please contact admin to get the support', 1000);
    }
  }

  public function sendMail($templateKey, $mailTo, array $data = null, $language = 'vi', $subject = false)
  {
    if (!$subject) {
      $subject = !isset(NotificationUtil::MAIL_SUBJECTS[$templateKey][$language]) ? 'N/A' : NotificationUtil::MAIL_SUBJECTS[$templateKey][$language];
    }
    $mailerEvent = new MailerEvent($subject, $templateKey, $mailTo, $data, $language);

    $this->getDispatcher()->dispatch(NotificationUtil::MAIL_EVENT, $mailerEvent);
  }

  public function throwException($message, $code = 1000)
  {
    throw new \Exception($message, $code);
  }

  public function parseBodyRequestData($getArray = false)
  {
    $data = $this->getRequest()->getContent();

    if (empty($data)) {
      throw new \Exception('Data is invalid', 1000);
    }

    try {
      return json_decode($data, $getArray);
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . '-' . $ex->getMessage());
      throw new \Exception('Data is invalid', 1000);
    }
  }

  public function getJsonInfo($fieldInfo)
  {
    return empty($fieldInfo) ? [] : json_decode($fieldInfo, true);
  }

  public function validateRequireFields($data, &$requiredFields, $isObject = true)
  {
    if (empty($data)) {
      throw new \Exception('Data is invalid', 1000);
    }

    foreach ($requiredFields as $field) {
      $inValid = ($isObject && !isset($data->$field) || (!$isObject && !isset($data[$field])));

      if ($inValid) {
        throw new \Exception($field . ' is required', 1000);
      }
    }
  }

  public function getEntityById($objectClass, $id)
  {
    $entityRepo = $this->getRepository($objectClass);
    $entity = $entityRepo->find($id);

    if (empty($entity)) {
      throw new NotFoundHttpException();
    }

    return $entity;
  }

  public function getEntityByConditions($objectClass, array $conditions, $getOne = true)
  {
    $entityRepo = $this->getRepository($objectClass);

    if ($getOne) {
      return $entityRepo->findOneBy($conditions);
    }

    return $entityRepo->findBy($conditions);
  }

  public function isGranted($permission)
  {
    return $this->authorizationChecker->isGranted($permission);
  }

  public function validCsrfToken($tokenId, $submittedToken)
  {
    $csrf = $this->getContainer()->get('security.csrf.token_manager');

    $isTokenValid = $csrf->isTokenValid(new CsrfToken($tokenId, $submittedToken));

    if (!$isTokenValid) {
      throw new \Exception('Data is invalid', 1000);
    }
  }

  public function getCurrentLocale() {
    $currentLocale = $this->getContainer()->get('request_stack')->getCurrentRequest()->headers->get('Locale');

    if (!$currentLocale) {
      return UserUtil::EN_LOCALE;
    }

    return $currentLocale;
  }

  public function getCurrentCompany()
  {
    $currentCompany = $this->getService('session')->get(PropertyCompanyUtil::CURRENT_COMPANY_SESSION_KEY);

    if (!$currentCompany) {
      $companies = $this->container->get(ServiceUtil::PROPERTY_COMPANY_SERVICE)->getAvailableCompaniesByUser($this->getLoggedUser());
      $currentCompany = @$companies[0];
      $this->container->get('session')->set(PropertyCompanyUtil::CURRENT_COMPANY_SESSION_KEY, $currentCompany);
    }

    return $currentCompany;
  }

  public function getCurrentProperty()
  {
    $currentProperty = $this->getService('session')->get(PropertyCompanyUtil::CURRENT_PROPERTY_SESSION_KEY);

    if (!$currentProperty) {
      $properties = $this->container->get(ServiceUtil::PROPERTY_COMPANY_SERVICE)->getAvailablePropertiesByCompany($this->getCurrentCompany());
      $currentProperty = @$properties[0];
      $this->container->get('session')->set(PropertyCompanyUtil::CURRENT_PROPERTY_SESSION_KEY, $currentProperty);
    }

    return $currentProperty;
  }
}
