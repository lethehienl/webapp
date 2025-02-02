<?php

namespace CompanyBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_property_company_user")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\PropertyCompanyUserRepository")
 */
class PropertyCompanyUser extends AbstractEntity
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   *
   * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\PropertyCompany")
   * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
   */
  private $company;

  /**
   *
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  private $user;

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id): void
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getUser()
  {
    return $this->user;
  }

  /**
   * @param mixed $user
   */
  public function setUser($user): void
  {
    $this->user = $user;
  }

  /**
   * @return mixed
   */
  public function getCompany()
  {
    return $this->company;
  }

  /**
   * @param mixed $company
   */
  public function setCompany($company): void
  {
    $this->company = $company;
  }
}
