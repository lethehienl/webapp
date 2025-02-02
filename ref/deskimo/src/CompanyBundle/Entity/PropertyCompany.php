<?php

namespace CompanyBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PropertyBundle\Entity\Property;

/**
 *
 * @ORM\Table(name="tbl_property_company")
 * @ORM\Entity(repositoryClass="CompanyBundle\Repository\PropertyCompanyRepository")
 */
class PropertyCompany extends AbstractEntity
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
   * @ORM\Column(name="contact_phone", type="string", length=32, nullable=true)
   */
  private $contactPhone;

  /**
   * @var string
   *
   * @ORM\Column(name="contact_name", type="string", length=512, nullable=true)
   */
  private $contactName;

  /**
   * @var string
   *
   * @ORM\Column(name="share_revenue_percent", type="float", nullable=true)
   */
  private $shareRevenuePercent = 0.35; //Percentage commission default 35%

  /**
   * @var string
   *
   * @ORM\Column(name="status", type="integer", nullable=true)
   */
  private $status;//1: active, 0: in-active

  /**
   *
   * @ORM\OneToMany(targetEntity="PropertyBundle\Entity\Property", mappedBy="company", cascade={"persist"})
   */
  private $properties;

  /**
   *
   * @ORM\OneToMany(targetEntity="CompanyBundle\Entity\PropertyCompanyUser", mappedBy="company")
   */
  private $propertyCompanyUsers;

  /**
   * @var
   *
   * @ORM\OneToMany(targetEntity="InvoiceBundle\Entity\Invoice", mappedBy="propertyCompany")
   */
  private $invoices;

  /**
   * @var string
   *
   * @ORM\Column(name="invoice_due_time", type="integer", nullable=true)
   */
  private $invoiceDueTime = '60 day';  //JIRA: 164 Payment terms in days (default 60)

  /**
   * @var string
   *
   * @ORM\Column(name="invoice_duration_time", type="string", length=32, nullable=true)
   */
  private $invoiceDurationTime ='1 month'; //JIRA: 164 Invoice is generated monthly

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
  private $processingFree; // JIRA: 164 float value to be added to the contract, this value will be in the currency of the contract, (default 5)


  public function __construct()
  {
    parent::__construct();
    $this->properties = new ArrayCollection();
    $this->propertyCompanyUsers = new ArrayCollection();
    $this->invoices = new ArrayCollection();
  }


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
   * @return string
   */
  public function getContactPhone()
  {
    return $this->contactPhone;
  }

  /**
   * @param string $contactPhone
   */
  public function setContactPhone($contactPhone)
  {
    $this->contactPhone = $contactPhone;
  }

  /**
   * @return string
   */
  public function getContactName()
  {
    return $this->contactName;
  }

  /**
   * @param string $contactName
   */
  public function setContactName(string $contactName): void
  {
    $this->contactName = $contactName;
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
  public function setShareRevenuePercent(string $shareRevenuePercent): void
  {
    $this->shareRevenuePercent = $shareRevenuePercent;
  }

  /**
   * @return string
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * @param string $status
   */
  public function setStatus(string $status): void
  {
    $this->status = $status;
  }

  /**
   * @return mixed
   */
  public function getProperties()
  {
    return $this->properties;
  }

  /**
   * @param mixed $properties
   */
  public function setProperties($properties): void
  {
    $this->properties = $properties;
  }

  public function addProperty(Property $property) {
    $this->properties->add($property);
    $property->setCompany($this);
  }

  /**
   * @return ArrayCollection
   */
  public function getPropertyCompanyUsers()
  {
    return $this->propertyCompanyUsers;
  }

  /**
   * @param ArrayCollection $propertyCompanyUsers
   */
  public function setPropertyCompanyUsers($propertyCompanyUsers)
  {
    $this->propertyCompanyUsers = $propertyCompanyUsers;
  }

  /**
   * @return string
   */
  public function getInvoiceDueTime()
  {
    return $this->invoiceDueTime;
  }

  /**
   * @param string $invoiceDueTime
   */
  public function setInvoiceDueTime($invoiceDueTime)
  {
    $this->invoiceDueTime = $invoiceDueTime;
  }

  /**
   * @return string
   */
  public function getInvoiceDurationTime()
  {
    return $this->invoiceDurationTime;
  }

  /**
   * @param string $invoiceDurationTime
   */
  public function setInvoiceDurationTime( $invoiceDurationTime)
  {
    $this->invoiceDurationTime = $invoiceDurationTime;
  }

  /**
   * @return mixed
   */
  public function getInvoices()
  {
    return $this->invoices;
  }

  /**
   * @param mixed $invoices
   */
  public function setInvoices($invoices)
  {
    $this->invoices = $invoices;
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



  public function __toString()
  {
    return $this->name;
  }
}
