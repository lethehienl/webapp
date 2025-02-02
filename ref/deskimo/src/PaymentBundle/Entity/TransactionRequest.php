<?php

namespace PaymentBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_transaction_request")
 * @ORM\Entity(repositoryClass="PaymentBundle\Repository\TransactionRequestRepository")
 */
class TransactionRequest extends AbstractEntity
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
   * @ORM\Column(name="expired_date", type="datetime", nullable=true)
   */
  private $expiredDate;

  /**
   *
   * @ORM\ManyToOne(targetEntity="VisitBundle\Entity\Visit")
   * @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
   */
  private $visit;

  /**
   *
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  private $user;

  /**
   *
   * @ORM\ManyToOne(targetEntity="PaymentBundle\Entity\PaymentInfo")
   * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id")
   */
  private $paymentMethod;

  /**
   *
   * @ORM\Column(name="status", type="integer", nullable=true)
   */
  private $status; //0: Pending, 1: Accepted

  /**
   * @return mixed
   */
  public function getPaymentMethod()
  {
    return $this->paymentMethod;
  }

  /**
   * @param mixed $paymentMethod
   */
  public function setPaymentMethod($paymentMethod): void
  {
    $this->paymentMethod = $paymentMethod;
  }

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

  public function getExpiredDate()
  {
    return $this->expiredDate;
  }

  public function setExpiredDate($expiredDate): void
  {
    $this->expiredDate = $expiredDate;
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
}

