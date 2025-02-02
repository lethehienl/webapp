<?php

namespace InvoiceBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_invoice_item_visit")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\InvoiceItemVisitRepository")
 */
class InvoiceItemVisit extends AbstractEntity
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
   * @ORM\ManyToOne(targetEntity="VisitBundle\Entity\Visit")
   * @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
   */
  private $visit;

  /**
   *
   * @ORM\ManyToOne(targetEntity="InvoiceBundle\Entity\InvoiceItem")
   * @ORM\JoinColumn(name="invoice_item_id", referencedColumnName="id")
   */
  private $invoiceItem;

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return ArrayCollection
   */
  public function getVisit()
  {
    return $this->visit;
  }

  /**
   * @param ArrayCollection $visit
   */
  public function setVisit($visit)
  {
    $this->visit = $visit;
  }

  /**
   * @return ArrayCollection
   */
  public function getInvoiceItem()
  {
    return $this->invoiceItem;
  }

  /**
   * @param ArrayCollection $invoiceProperty
   */
  public function setInvoiceItem($invoiceItem)
  {
    $this->invoiceItem = $invoiceItem;
  }


}
