<?php

namespace PaymentBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentActivity
 *
 * @ORM\Table(name="tbl_payment_activity")
 * @ORM\Entity(repositoryClass="PaymentBundle\Repository\PaymentActivityRepository")
 */
class PaymentActivity extends AbstractEntity
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
   * @ORM\Column(name="log", type="text", nullable=true)
   */
  private $log;

  /**
   * @ORM\ManyToOne(targetEntity="PaymentBundle\Entity\PaymentInfo", inversedBy="paymentActivities", cascade="persist")
   * @ORM\JoinColumn(name="payment_info_id", referencedColumnName="id")
   */
  protected $paymentInfo;


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
   * @return string|null
   */
  public function getLog()
  {
    return $this->log;
  }

  /**
   * @param string|null $log
   */
  public function setLog($log)
  {
    $this->log = $log;
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
}
