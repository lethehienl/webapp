<?php

namespace InvoiceBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_invoice_item")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\InvoiceItemRepository")
 */
class InvoiceItem extends AbstractEntity
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
   * @ORM\ManyToOne(targetEntity="InvoiceBundle\Entity\Invoice")
   * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
   */
  private $invoice;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=512, nullable=true)
   */
  private $name;


  /**
   *
   * @ORM\Column(name="total_price", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $totalPrice = 0;

  /**
   *
   * @ORM\Column(name="unit", type="decimal", precision=11, scale=0, nullable=true)
   */
  private $unit = 0;

  /**
   *
   * @ORM\Column(name="quantity", type="integer", nullable=true)
   */
  private $ratePerHour = 0;


  /**
   * @var
   *
   * @ORM\OneToMany(targetEntity="InvoiceBundle\Entity\InvoiceItemVisit", mappedBy="invoiceItem")
   */
  private $invoiceItemVisits;

  public function __construct()
  {
    parent::__construct();
    $this->invoiceItemVisits = new ArrayCollection();
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getInvoice()
  {
    return $this->invoice;
  }

  /**
   * @param mixed $invoice
   */
  public function setInvoice($invoice)
  {
    $this->invoice = $invoice;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return int
   */
  public function getTotalPrice()
  {
    return $this->totalPrice;
  }

  /**
   * @param int $totalPrice
   */
  public function setTotalPrice($totalPrice)
  {
    $this->totalPrice = $totalPrice;
  }

  /**
   * @return int
   */
  public function getUnit()
  {
    return $this->unit;
  }

  /**
   * @param int $unit
   */
  public function setUnit($unit)
  {
    $this->unit = $unit;
  }

  /**
   * @return int
   */
  public function getRatePerHour()
  {
    return $this->ratePerHour;
  }

  /**
   * @param int $ratePerHour
   */
  public function setRatePerHour($ratePerHour)
  {
    $this->ratePerHour = $ratePerHour;
  }

  /**
   * @return mixed
   */
  public function getInvoiceItemVisits()
  {
    return $this->invoiceItemVisits;
  }

  /**
   * @param mixed $invoiceItemVisits
   */
  public function setInvoiceItemVisits($invoiceItemVisits)
  {
    $this->invoiceItemVisits = $invoiceItemVisits;
  }


}
