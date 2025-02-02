<?php

namespace InvoiceBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_invoice")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\InvoiceRepository")
 */
class Invoice extends AbstractEntity
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
   * @ORM\Column(name="invocie_no", type="string", length=128, unique=true)
   */
  private $invoiceNo;

  /**
   *
   * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\PropertyCompany")
   * @ORM\JoinColumn(name="property_company_id", referencedColumnName="id")
   */
  private $propertyCompany;

  /**
   *
   * @ORM\Column(name="invoice_date", type="datetime", nullable=true)
   */
  private $invoiceDate;

  /**
   *
   * @ORM\Column(name="due_date", type="datetime", nullable=true)
   */
  private $dueDate;

  /**
   *
   * @ORM\Column(name="invoice_from", type="datetime", nullable=true)
   */
  private $invoiceFrom;

  /**
   *
   * @ORM\Column(name="invoice_to", type="datetime", nullable=true)
   */
  private $invoiceTo;

  /**
   *
   * @var string
   *
   * @ORM\Column(name="invoice_pdf", type="string", length=511,  nullable=true)
   */
  private $invoicePdf;
  private $invoicePdfTmp;

  /**
   * @var string
   *
   * @ORM\Column(name="share_revenue_percent", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $shareRevenuePercent;

  /**
   * @var string
   *
   * @ORM\Column(name="share_revenue_total", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $shareRevenueTotal;

  /**
   *
   * @ORM\Column(name="sub_total", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $subTotal = 0;

  /**
   *
   * @ORM\Column(name="tax_rate", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $taxRate = 0;

  /**
   *
   * @ORM\Column(name="tax_total", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $taxTotal = 0;

  /**
   *
   * @ORM\Column(name="total", type="decimal", precision=11, scale=4, nullable=true)
   */
  private $total = 0;


  /**
   * @var
   *
   * @ORM\OneToMany(targetEntity="InvoiceBundle\Entity\InvoiceItem", mappedBy="invoice")
   */
  private $invoiceItems;

  /**
   *
   * @ORM\Column(name="status", type="integer", nullable=true)
   */
  private $status; //0: In-active, 1: Active

  /**
   * @var string
   *
   * @ORM\Column(name="currency", type="string", length=32, nullable=true)
   */
  private $currency; //JIRA: 164 Currency of the contract: SGD, USD, etc… right now default SGD

  /**
   * @var string
   *
   * @ORM\Column(name="processing_free", type="float", nullable=true)
   */
  private $processingFree; // JIRA: 164 this value will be in the currency of the contract



  public function __construct()
  {
    parent::__construct();
    $this->invoiceItems = new ArrayCollection();
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getInvoiceNo()
  {
    return $this->invoiceNo;
  }

  /**
   * @param string $invoiceNo
   */
  public function setInvoiceNo( $invoiceNo)
  {
    $this->invoiceNo = $invoiceNo;
  }

  /**
   * @return mixed
   */
  public function getPropertyCompany()
  {
    return $this->propertyCompany;
  }

  /**
   * @param mixed $propertyCompany
   */
  public function setPropertyCompany($propertyCompany)
  {
    $this->propertyCompany = $propertyCompany;
  }

  /**
   * @return mixed
   */
  public function getInvoiceDate()
  {
    return $this->invoiceDate;
  }

  /**
   * @param mixed $invoiceDate
   */
  public function setInvoiceDate($invoiceDate)
  {
    $this->invoiceDate = $invoiceDate;
  }

  /**
   * @return mixed
   */
  public function getDueDate()
  {
    return $this->dueDate;
  }

  /**
   * @param mixed $dueDate
   */
  public function setDueDate($dueDate)
  {
    $this->dueDate = $dueDate;
  }

  /**
   * @return mixed
   */
  public function getInvoiceFrom()
  {
    return $this->invoiceFrom;
  }

  /**
   * @param mixed $invoiceFrom
   */
  public function setInvoiceFrom($invoiceFrom)
  {
    $this->invoiceFrom = $invoiceFrom;
  }

  /**
   * @return mixed
   */
  public function getInvoiceTo()
  {
    return $this->invoiceTo;
  }

  /**
   * @param mixed $invoiceTo
   */
  public function setInvoiceTo($invoiceTo)
  {
    $this->invoiceTo = $invoiceTo;
  }

  /**
   * @return string
   */
  public function getInvoicePdf()
  {
    return $this->invoicePdf;
  }

  /**
   * @param string $invoicePdf
   */
  public function setInvoicePdf( $invoicePdf)
  {
    $this->invoicePdf = $invoicePdf;
  }

  /**
   * @return mixed
   */
  public function getInvoicePdfTmp()
  {
    return $this->invoicePdfTmp;
  }

  /**
   * @param mixed $invoicePdfTmp
   */
  public function setInvoicePdfTmp($invoicePdfTmp)
  {
    $this->invoicePdfTmp = $invoicePdfTmp;
  }

  /**
   * @return string
   */
  public function getShareRevenuePercent()
  {
    return $this->shareRevenuePercent;
  }

  /**
   * @param string $shareRevenuePercent
   */
  public function setShareRevenuePercent( $shareRevenuePercent)
  {
    $this->shareRevenuePercent = $shareRevenuePercent;
  }

  /**
   * @return string
   */
  public function getShareRevenueTotal()
  {
    return $this->shareRevenueTotal;
  }

  /**
   * @param string $shareRevenueTotal
   */
  public function setShareRevenueTotal( $shareRevenueTotal)
  {
    $this->shareRevenueTotal = $shareRevenueTotal;
  }

  /**
   * @return int
   */
  public function getSubTotal()
  {
    return $this->subTotal;
  }

  /**
   * @param int $subTotal
   */
  public function setSubTotal($subTotal)
  {
    $this->subTotal = $subTotal;
  }

  /**
   * @return int
   */
  public function getTaxRate()
  {
    return $this->taxRate;
  }

  /**
   * @param int $taxRate
   */
  public function setTaxRate( $taxRate)
  {
    $this->taxRate = $taxRate;
  }

  /**
   * @return int
   */
  public function getTaxTotal()
  {
    return $this->taxTotal;
  }

  /**
   * @param int $taxTotal
   */
  public function setTaxTotal( $taxTotal)
  {
    $this->taxTotal = $taxTotal;
  }

  /**
   * @return int
   */
  public function getTotal()
  {
    return $this->total;
  }

  /**
   * @param int $total
   */
  public function setTotal( $total)
  {
    $this->total = $total;
  }

  /**
   * @return mixed
   */
  public function getInvoiceProperties()
  {
    return $this->invoiceItems;
  }

  /**
   * @param mixed $invoiceItems
   */
  public function setInvoiceProperties($invoiceItems)
  {
    $this->invoiceItems = $invoiceItems;
  }

  /**
   * @return mixed
   */
  public function getInvoiceItems()
  {
    return $this->invoiceItems;
  }

  /**
   * @param mixed $invoiceItems
   */
  public function setInvoiceItems($invoiceItems)
  {
    $this->invoiceItems = $invoiceItems;
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
  public function setStatus($status)
  {
    $this->status = $status;
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
  public function setCurrency( $currency)
  {
    $this->currency = $currency;
  }

  /**
   * @return string
   */
  public function getProcessingFree()
  {
    return $this->processingFree;
  }

  /**
   * @param string $processingFree
   */
  public function setProcessingFree( $processingFree)
  {
    $this->processingFree = $processingFree;
  }

}
