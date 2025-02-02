<?php


namespace AppBundle\Twig;


use AppBundle\Utils\ServiceUtil;
use CompanyBundle\Entity\PropertyCompany;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use UserBundle\Entity\User;

class AppExtension extends AbstractExtension
{
  private $container;

  /**
   * AppExtension constructor.
   */
  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function getFunctions()
  {
    return [
      new TwigFunction('getCompaniesByUser', [$this, 'getCompaniesByUser']),
      new TwigFunction('getPropertiesByCompany', [$this, 'getPropertiesByCompany']),
    ];
  }

  public function getCompaniesByUser(UserInterface $user)
  {
    $companies = $this->container->get(ServiceUtil::PROPERTY_COMPANY_SERVICE)->getAvailableCompaniesByUser($user);
    return $companies;
  }

  public function getPropertiesByCompany($company)
  {
    $properties = [];
    if ($company instanceof PropertyCompany) {
      $properties = $this->container->get(ServiceUtil::PROPERTY_COMPANY_SERVICE)->getAvailablePropertiesByCompany($company);
    }

    return $properties;
  }
}