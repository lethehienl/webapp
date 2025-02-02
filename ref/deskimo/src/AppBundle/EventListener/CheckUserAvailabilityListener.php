<?php

namespace AppBundle\EventListener;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\ServiceUtil;
use CompanyBundle\Services\PropertyCompanyService;
use CompanyBundle\Utils\PropertyCompanyUtil;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use UserBundle\Entity\User;

class CheckUserAvailabilityListener
{
  private $container;

  /**
   * CheckUserAvailabilityListener constructor.
   */
  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function onKernelRequest(GetResponseEvent $event)
  {
    if (!$event->isMasterRequest()) {
      return;
    }

    $path = $event->getRequest()->getPathInfo();

    if (strpos($path, '/api/') === 0 || strpos($path, '/oauth/') === 0) {
      return;
    }

    if (!($this->container->get(ServiceUtil::ABSTRACT_SERVICE)->getLoggedUser() instanceof User)) {
      return;
    }

    try {
      $this->container->get(ServiceUtil::ABSTRACT_SERVICE)->getCurrentCompany();
      $this->container->get(ServiceUtil::ABSTRACT_SERVICE)->getCurrentProperty();
    } catch (\Exception $ex) {

    }
  }
}