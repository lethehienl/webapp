<?php

namespace PaymentBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="tbl_transaction")
 * @ORM\Entity(repositoryClass="PaymentBundle\Repository\TransactionRepository")
 */
class Transaction extends AbstractEntity
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
   * @ORM\Column(name="token", type="string", length=512, nullable=true)
   */
  private $token;

  /**
   * @var float
   *
   * @ORM\Column(name="amount", type="float", nullable=true)
   */
  private $amount;

  /**
   * @var string
   *
   * @ORM\Column(name="currency", type="string", length=32, nullable=true)
   */
  private $currency;

  /**
   * @var string
   *
   * @ORM\Column(name="transaction_ref", type="string", length=512, nullable=true)
   */
  private $transactionRef; //Stripe: payment_intent_id

  /**
   *
   * @ORM\ManyToOne(targetEntity="PaymentBundle\Entity\TransactionRequest")
   * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
   */
  private $request;

  /**
   * @var int
   *
   * @ORM\Column(name="status", type="smallint", nullable=true)
   */
  private $status;//0: Pending, 1: Finished, 2: Fail

  /**
   * @ORM\ManyToOne(targetEntity="PaymentBundle\Entity\PaymentInfo", inversedBy="transactions")
   * @ORM\JoinColumn(name="payment_info_id", referencedColumnName="id")
   */
  protected $paymentInfo;

  /**
   * @ORM\ManyToOne(targetEntity="VisitBundle\Entity\Visit", inversedBy="transactions")
   * @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
   */
  protected $visit;

  /**
   *
   * @ORM\OneToMany(targetEntity="PaymentBundle\Entity\TransactionActivity", mappedBy="transaction", cascade="persist")
   */
  private $transactionActivities;

  public function __construct()
  {
    parent::__construct();
    $this->transactionActivities = new ArrayCollection();
  }

  /**
   * Get id.
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set amount.
   *
   * @param float $amount
   *
   * @return Transaction
   */
  public function setAmount($amount)
  {
    $this->amount = $amount;

    return $this;
  }

  /**
   * Get amount.
   *
   * @return float
   */
  public function getAmount()
  {
    return $this->amount;
  }

  /**
   * Set transactionRef.
   *
   * @param string $transactionRef
   *
   * @return Transaction
   */
  public function setTransactionRef($transactionRef)
  {
    $this->transactionRef = $transactionRef;

    return $this;
  }

  /**
   * Get transactionRef.
   *
   * @return string
   */
  public function getTransactionRef()
  {
    return $this->transactionRef;
  }

  /**
   * Set status.
   *
   * @param int $status
   *
   * @return Transaction
   */
  public function setStatus($status)
  {
    $this->status = $status;

    return $this;
  }

  /**
   * Get status.
   *
   * @return int
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * @return mixed
   */
  public function getPaymentInfo()
  {
    return $this->paymentInfo;
  }

  /**
   * @param mixed $paymentInfo
   */
  public function setPaymentInfo($paymentInfo)
  {
    $this->paymentInfo = $paymentInfo;
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
  public function setVisit($visit)
  {
    $this->visit = $visit;
  }

  /**
   * @return ArrayCollection
   */
  public function getTransactionActivities()
  {
    return $this->transactionActivities;
  }

  /**
   * @param ArrayCollection $transactionActivities
   */
  public function setTransactionActivities($transactionActivities)
  {
    $this->transactionActivities = $transactionActivities;
  }

  public function addTransactionActivity(TransactionActivity $transactionActivity) {
    $this->transactionActivities->add($transactionActivity);
    $transactionActivity->setTransaction($this);
  }

  /**
   * @return string
   */
  public function getCurrency()
  {
    return $this->currency;
  }

  /**
   * @param string $currency
   */
  public function setCurrency($currency)
  {
    $this->currency = $currency;
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
  public function getRequest()
  {
    return $this->request;
  }

  /**
   * @param mixed $request
   */
  public function setRequest($request): void
  {
    $this->request = $request;
  }
}
