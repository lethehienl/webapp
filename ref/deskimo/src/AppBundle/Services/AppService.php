<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AppService
{
  private $request;
  private $entityManager;
  private $container;
  private $tokenStorage;

  /**
   * AppService constructor.
   */
  public function __construct(
    EntityManagerInterface $entityManager,
    RequestStack $requestStack,
    ContainerInterface $container,
    TokenStorageInterface $tokenStorage
  )
  {
    $this->container = $container;
    $this->entityManager = $entityManager;
    $this->tokenStorage = $tokenStorage;
    $this->request = $requestStack->getCurrentRequest();
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

    return $token->getUser();
  }

  public function isRole($currentRole)
  {
    $token = $this->tokenStorage->getToken();

    if (!$token) {
      return null;
    }

    foreach ($token->getRoles() as $role) {
      if ($role->getRole() == $currentRole) {
        return true;
      }
    }

    return false;
  }
}
