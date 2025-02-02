<?php

namespace PropertyBundle\Services;

use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Entity\PropertyBenefit;
use PropertyBundle\Entity\PropertyLocation;
use UserBundle\Entity\User;
use AppBundle\Services\AbstractService;
use UserBundle\Repository\UserRepository;

class PropertyLocationService extends AbstractService
{
  public function create(PropertyLocation $propertyLocation)
  {

    $this->getEntityManager()->persist($propertyLocation);
    $this->getEntityManager()->flush();
  }

  public function update(PropertyLocation $propertyLocation)
  {
    $this->getEntityManager()->persist($propertyLocation);
    $this->getEntityManager()->flush();
  }

  public function delete(PropertyLocation $propertyLocation)
  {
    try {
      $this->getEntityManager()->remove($propertyLocation);
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
      /** @var PropertyLocationRepository $propertyLocationRepo */
      $propertyLocationRepo = $this->getEntityManager()->getRepository(PropertyLocation::class);
      $total = (int)$propertyLocationRepo->getTotalDatatale($keyword);

      if ($total == 0) {
        return $data;
      }

      $items = $propertyLocationRepo->getDatatale($keyword, $itemPerPages, $startOffset);
      $items = $this->decorateDatatables($items);

      $data = array(
        'draw' => $draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $items
      );

      return $data;
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . ' SEARCH PROPERTY LOCATION: ' . $ex->getMessage());
      return $data;
    }
  }

  private function decorateDatatables($items)
  {
    $info = array();

    if (empty($items)) {
      return $info;
    }

    /** @var PropertyLocation $item */
    foreach ($items as $item) {
      $updatedDate = DateTimeUtil::formatDate($item->getUpdatedAt());

      $info[] = array(
        $item->getId(),
        '',
        $item->getName(),
        $item->getCountry(),
        $item->getCity(),
        $updatedDate,
      );
    }

    return $info;
  }

  public function getDetail($id)
  {
    return $this->getEntityManager()->getRepository(PropertyLocation::class)->find($id);
  }

  public function save($entity)
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