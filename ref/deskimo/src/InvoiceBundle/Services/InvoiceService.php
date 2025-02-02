<?php

namespace InvoiceBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Services\EmailNotificationService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\EmailUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StatusUtil;
use CompanyBundle\Entity\PropertyCompany;
use CompanyBundle\Repository\PropertyCompanyRepository;
use CompanyBundle\Utils\PropertyCompanyUtil;
use InvoiceBundle\Entity\Invoice;
use PropertyBundle\Entity\Property;
use UserBundle\Entity\User;
use UserBundle\Services\UserService;
use UserBundle\Utils\RolesUtil;
use UserBundle\Utils\UserUtil;

class InvoiceService extends AbstractService
{
  public function create(Invoice $invoice)
  {
    //$this->updatePropertyBenefitImage($amenity);
    $this->getEntityManager()->persist($invoice);
    $this->getEntityManager()->flush();
  }

  public function update(Invoice $invoice)
  {
    // $this->updatePropertyBenefitImage($propertyBenefit, $oldImage);

    $this->getEntityManager()->persist($invoice);
    $this->getEntityManager()->flush();
  }

  public function delete(Invoice $invoice)
  {
    try {
      $this->getEntityManager()->remove($invoice);
      $this->getEntityManager()->flush();
    } catch (Exception $e) {
      return false;
    }
    return true;
  }

  public function getDatatable()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');

    $startOffset = $this->getRequest()->get('start');
    $itemPerPages = $this->getRequest()->get('length');

    $data = array(
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => array(),
    );

    try {
      /** @var PropertyCompanyRepository $propertyCompanyRepo */
      $propertyCompanyRepo = $this->getEntityManager()->getRepository(Invoice::class);
      $total = (int)$propertyCompanyRepo->getTotalDatatale($keyword);

      if ($total == 0) {
        return $data;
      }

      $items = $propertyCompanyRepo->getDatatale($keyword, $itemPerPages, $startOffset);
      $items = $this->decorateDatatables($items);

      $data = array(
        'draw' => $draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $items
      );

      return $data;
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . ' SEARCH INVOICE: ' . $ex->getMessage());
      return $data;
    }
  }

  private function decorateDatatables($items)
  {
    $info = array();

    if (empty($items)) {
      return $info;
    }

    /** @var Invoice $item */
    foreach ($items as $item) {
      $updatedDate = DateTimeUtil::formatDate($item->getUpdatedAt());
      $invoiceDate = DateTimeUtil::formatDate($item->getInvoiceDate());
      $status = $item->getStatus();
      $status = StatusUtil::STATUS_MAPPING[$status];
      $info[] = array(
        $item->getId(),
        '',
        $item->getInvoiceNo(),
        (string)$item->getPropertyCompany(),
        $invoiceDate,
        //$item->getImage(),
        $status,
        //  (!empty($item->getIsFree()) ? 'No' : 'Yes'),
        $updatedDate
      );
    }

    return $info;
  }

  public function getDetail($id)
  {
    return $this->getEntityManager()->getRepository(Invoice::class)->find($id);
  }

  public function saveDetail($entity)
  {

    try {
      $this->getEntityManager()->merge($entity);
      $this->getEntityManager()->flush();
    } catch (Exception $e) {
      return false;
    }
    return true;
  }

}
