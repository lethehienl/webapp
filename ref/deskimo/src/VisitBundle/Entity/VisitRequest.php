<?php

namespace VisitBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_visit_request")
 * @ORM\Entity(repositoryClass="VisitBundle\Repository\VisitRequestRepository")
 */
class VisitRequest extends AbstractEntity
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
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=12, nullable=true)
   */
  private $code;

  /**
   * @var string
   *
   * @ORM\Column(name="token", type="string", length=256, nullable=true)
   */
  private $token;

  /**
   *
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  private $user;

  /**
   *
   * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Property")
   * @ORM\JoinColumn(name="property_id", referencedColumnName="id", nullable=true)
   */
  private $property;

  /**
   *
   * @ORM\Column(name="expired_time", type="datetime", nullable=true)
   */
  private $expiredTime;

  /**
   *
   * @ORM\Column(name="status", type="integer", nullable=true)
   */
  private $status; //0:pending, 1: accepted, 2: expired

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
   * @return string
   */
  public function getCode(): string
  {
    return $this->code;
  }

  /**
   * @param string $code
   */
  public function setCode(string $code): void
  {
    $this->code = $code;
  }

  /**
   * @return string
   */
  public function getToken(): string
  {
    return $this->token;
  }

  /**
   * @param string $token
   */
  public function setToken(string $token): void
  {
    $this->token = $token;
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
  public function getProperty()
  {
    return $this->property;
  }

  /**
   * @param mixed $property
   */
  public function setProperty($property): void
  {
    $this->property = $property;
  }

  /**
   * @return mixed
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * @param mixed $status
   */
  public function setStatus($status): void
  {
    $this->status = $status;
  }

  /**
   * @return mixed
   */
  public function getExpiredTime()
  {
    return $this->expiredTime;
  }

  /**
   * @param mixed $expiredTime
   */
  public function setExpiredTime($expiredTime): void
  {
    $this->expiredTime = $expiredTime;
  }
}
