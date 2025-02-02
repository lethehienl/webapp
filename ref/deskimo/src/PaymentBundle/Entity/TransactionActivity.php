<?php

namespace PaymentBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TransactionActivity
 *
 * @ORM\Table(name="tbl_transaction_activity")
 * @ORM\Entity(repositoryClass="PaymentBundle\Repository\TransactionActivityRepository")
 */
class TransactionActivity extends AbstractEntity
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
   * @ORM\Column(name="log", type="text")
   */
  private $log;

  /**
   * @ORM\ManyToOne(targetEntity="PaymentBundle\Entity\Transaction", inversedBy="transactionActivities", cascade="persist")
   * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
   */
  protected $transaction;

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
   * Set log.
   *
   * @param string $log
   *
   * @return TransactionActivity
   */
  public function setLog($log)
  {
    $this->log = $log;

    return $this;
  }

  /**
   * Get log.
   *
   * @return string
   */
  public function getLog()
  {
    return $this->log;
  }

  /**
   * @return mixed
   */
  public function getTransaction()
  {
    return $this->transaction;
  }

  /**
   * @param mixed $transaction
   */
  public function setTransaction($transaction)
  {
    $this->transaction = $transaction;
  }
}
