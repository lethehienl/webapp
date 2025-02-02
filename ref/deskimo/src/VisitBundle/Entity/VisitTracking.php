<?php

namespace VisitBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_visit_tracking")
 * @ORM\Entity(repositoryClass="VisitBundle\Repository\VisitTrackingRepository")
 */
class VisitTracking extends AbstractEntity
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
   * @ORM\ManyToOne(targetEntity="VisitBundle\Entity\Visit")
   * @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
   */
  private $visit;

  /**
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=256, nullable=true)
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
   * @param int $id
   */
  public function setId(int $id): void
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getVisit()
  {
    return $this->visit;
  }

  /**
   * @param mixed $visit
   */
  public function setVisit($visit): void
  {
    $this->visit = $visit;
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
}
