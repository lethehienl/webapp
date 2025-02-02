<?php

namespace VisitBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_visit")
 * @ORM\Entity(repositoryClass="VisitBundle\Repository\VisitRepository")
 */
class Visit extends AbstractEntity
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
   * @ORM\Column(name="name", type="string", length=512, nullable=true)
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=512, nullable=true)
   */
  private $code;

  /**
   * @ORM\Column(name="address", type="string", length=1024, nullable=true)
   */
  private $address;

  /**
   * @ORM\Column(name="is_reviewed", type="integer", nullable=true)
   */
  private $isReviewed = 0; //0: waiting for review, 1: reviewed

  /**
   * @var string
   *
   * @ORM\Column(name="token", type="string", length=512, nullable=true)
   */
  private $token;

  /**
   *
   * @ORM\ManyToOne(targetEntity="VisitBundle\Entity\VisitRequest")
   * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
   */
  private $visitRequest;

  /**
   *
   * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Property")
   * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
   */
  private $property;

  /**
   *
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  private $user;

  /**
   *
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
   */
  private $staff;

  /**
   *
   * @ORM\Column(name="rate_per_hour", type="float", nullable=true)
   */
  private $ratePerHour = 0;

  /**
   *
   * @ORM\Column(name="start_time", type="datetime", nullable=true)
   */
  private $startTime;

  /**
   *
   * @ORM\Column(name="end_time", type="datetime", nullable=true)
   */
  private $endTime;

  /**
   *
   * @ORM\Column(name="payment_currency", type="string", length=12, nullable=true)
   */
  private $paymentCurrency;

  /**
   *
   * @ORM\Column(name="total_time", type="integer", nullable=true)
   */
  private $totalTime = 0; //minutes

  /**
   *
   * @ORM\Column(name="total_price", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $totalPrice = 0;

  /**
   *
   * @ORM\Column(name="status", type="integer", nullable=true)
   */
  private $status = 0; //0: on-going, 1: Finish visit, 2: Finish Payment

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
   * @return mixed
   */
  public function getVisitRequest()
  {
    return $this->visitRequest;
  }

  /**
   * @param mixed $visitRequest
   */
  public function setVisitRequest($visitRequest): void
  {
    $this->visitRequest = $visitRequest;
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
   * @return string
   */
  public function getRatePerHour(): string
  {
    return $this->ratePerHour;
  }

  /**
   * @param string $ratePerHour
   */
  public function setRatePerHour(string $ratePerHour): void
  {
    $this->ratePerHour = $ratePerHour;
  }

  /**
   * @return mixed
   */
  public function getStartTime()
  {
    return $this->startTime;
  }

  /**
   * @param mixed $startTime
   */
  public function setStartTime($startTime): void
  {
    $this->startTime = $startTime;
  }

  /**
   * @return mixed
   */
  public function getEndTime()
  {
    return $this->endTime;
  }

  /**
   * @param mixed $endTime
   */
  public function setEndTime($endTime): void
  {
    $this->endTime = $endTime;
  }

  /**
   * @return mixed
   */
  public function getTotalTime()
  {
    return $this->totalTime;
  }

  /**
   * @param mixed $totalTime
   */
  public function setTotalTime($totalTime): void
  {
    $this->totalTime = $totalTime;
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
  public function getPaymentCurrency()
  {
    return $this->paymentCurrency;
  }

  /**
   * @param mixed $paymentCurrency
   */
  public function setPaymentCurrency($paymentCurrency): void
  {
    $this->paymentCurrency = $paymentCurrency;
  }

  public function getName()
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name): void
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getTotalPrice()
  {
    return $this->totalPrice;
  }

  /**
   * @param mixed $totalPrice
   */
  public function setTotalPrice($totalPrice): void
  {
    $this->totalPrice = $totalPrice;
  }

  /**
   * @return mixed
   */
  public function getStaff()
  {
    return $this->staff;
  }

  /**
   * @param mixed $staff
   */
  public function setStaff($staff): void
  {
    $this->staff = $staff;
  }

  /**
   * @return mixed
   */
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * @param mixed $address
   */
  public function setAddress($address): void
  {
    $this->address = $address;
  }

  public function getIsReviewed()
  {
    return $this->isReviewed;
  }

  public function setIsReviewed($isReviewed): void
  {
    $this->isReviewed = $isReviewed;
  }
}
