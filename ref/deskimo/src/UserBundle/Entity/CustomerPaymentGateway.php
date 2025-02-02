<?php

namespace UserBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerPaymentGateway
 *
 * @ORM\Table(name="tbl_customer_payment_gateway")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\CustomerPaymentGatewayRepository")
 */
class CustomerPaymentGateway extends AbstractEntity
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
   * @ORM\Column(name="customer_ref", type="string", length=512)
   */
  private $customerRef;

  /**
   * @var string
   *
   * @ORM\Column(name="type", type="string", length=512)
   */
  private $type;

  /**
   * @var int
   *
   * @ORM\Column(name="status", type="smallint")
   */
  private $status;

  /**
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="customerPaymentGateways", cascade="persist")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  protected $user;

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
   * Set customerRef.
   *
   * @param string $customerRef
   *
   * @return CustomerPaymentGateway
   */
  public function setCustomerRef($customerRef)
  {
    $this->customerRef = $customerRef;

    return $this;
  }

  /**
   * Get customerRef.
   *
   * @return string
   */
  public function getCustomerRef()
  {
    return $this->customerRef;
  }

  /**
   * Set status.
   *
   * @param int $status
   *
   * @return CustomerPaymentGateway
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
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * @param string $type
   */
  public function setType($type)
  {
    $this->type = $type;
  }
}
