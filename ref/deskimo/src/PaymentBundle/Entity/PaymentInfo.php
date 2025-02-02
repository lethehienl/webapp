<?php

namespace PaymentBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentInfo
 *
 * @ORM\Table(name="tbl_payment_info")
 * @ORM\Entity(repositoryClass="PaymentBundle\Repository\PaymentInfoRepository")
 */
class PaymentInfo extends AbstractEntity
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
   * @var string|null
   *
   * @ORM\Column(name="customer_ref", type="string", length=512, nullable=true)
   */
  private $customerRef;

  /**
   * @var string|null
   *
   * @ORM\Column(name="payment_method_ref", type="string", length=512, nullable=true)
   */
  private $paymentMethodRef;

  /**
   * @var string|null
   *
   * @ORM\Column(name="payment_gateway", type="string", length=512, nullable=true)
   */
  private $paymentGateway;

  /**
   * @var string|null
   *
   * @ORM\Column(name="card_info", type="text", nullable=true)
   */
  private $cardInfo;

  /**
   * @var int
   *
   * @ORM\Column(name="status", type="smallint")
   */
  private $status;

  /**
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="paymentInfos")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  protected $user;

  /**
   *
   * @ORM\OneToMany(targetEntity="PaymentBundle\Entity\PaymentActivity", mappedBy="paymentInfo", cascade="persist")
   */
  private $paymentActivities;

  public function __construct()
  {
    parent::__construct();
    $this->paymentActivities = new ArrayCollection();
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
   * Set cardInfo.
   *
   * @param string|null $cardInfo // decrypt
   *
   * @return PaymentInfo
   */
  public function setCardInfo($cardInfo = null)
  {
    $this->cardInfo = $cardInfo;
    return $this;
  }

  /**
   * Get cardInfo.
   *
   * @return string|null
   */
  public function getCardInfo()
  {
    return $this->cardInfo;
  }

  /**
   * Set status.
   *
   * @param int $status
   *
   * @return PaymentInfo
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
  public function getUser()
  {
    return $this->user;
  }

  /**
   * @param mixed $user
   */
  public function setUser($user)
  {
    $this->user = $user;
  }

  /**
   * @return ArrayCollection
   */
  public function getPaymentActivities()
  {
    return $this->paymentActivities;
  }

  /**
   * @param ArrayCollection $paymentActivities
   */
  public function setPaymentActivities($paymentActivities)
  {
    $this->paymentActivities = $paymentActivities;
  }

  public function addPaymentActivity(PaymentActivity $paymentActivity) {
    $this->paymentActivities->add($paymentActivity);
    $paymentActivity->setPaymentInfo($this);
  }

  /**
   * @return string|null
   */
  public function getPaymentGateway()
  {
    return $this->paymentGateway;
  }

  /**
   * @param string|null $paymentGateway
   */
  public function setPaymentGateway($paymentGateway)
  {
    $this->paymentGateway = $paymentGateway;
  }

  /**
   * @return string|null
   */
  public function getCustomerRef()
  {
    return $this->customerRef;
  }

  /**
   * @param string|null $customerRef
   */
  public function setCustomerRef($customerRef)
  {
    $this->customerRef = $customerRef;
  }

  /**
   * @return string|null
   */
  public function getPaymentMethodRef()
  {
    return $this->paymentMethodRef;
  }

  /**
   * @param string|null $paymentMethodRef
   */
  public function setPaymentMethodRef($paymentMethodRef)
  {
    $this->paymentMethodRef = $paymentMethodRef;
  }
}
