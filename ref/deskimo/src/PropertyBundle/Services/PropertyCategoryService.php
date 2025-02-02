<?php

namespace PropertyBundle\Services;

use AppBundle\Utils\DateTimeUtil;
use PropertyBundle\Entity\PropertyCategory;
use PropertyBundle\Repository\PropertyCategoryRepository;
use AppBundle\Services\AbstractService;


class PropertyCategoryService extends AbstractService
{
  public function create(PropertyCategory $propertyCategory)
  {

    $this->getEntityManager()->persist($propertyCategory);
    $this->getEntityManager()->flush();
  }

  public function update(PropertyCategory $propertyCategory)
  {
    $this->getEntityManager()->persist($propertyCategory);
    $this->getEntityManager()->flush();
  }

  public function delete(PropertyCategory $propertyCategory)
  {
    try {
      $this->getEntityManager()->remove($propertyCategory);
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
      /** @var PropertyCategoryRepository $propertyCategoryRepo */
      $propertyCategoryRepo = $this->getEntityManager()->getRepository(PropertyCategory::class);
      $total = (int)$propertyCategoryRepo->getTotalDatatale($keyword);

      if ($total == 0) {
        return $data;
      }

      $items = $propertyCategoryRepo->getDatatale($keyword, $itemPerPages, $startOffset);
      $items = $this->decorateDatatables($items);

      $data = array(
        'draw' => $draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $items
      );

      return $data;
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . ' SEARCH PROPERTY: ' . $ex->getMessage());
      return $data;
    }
  }

  private function decorateDatatables($items)
  {
    $info = array();

    if (empty($items)) {
      return $info;
    }

    /** @var PropertyCategory $item */
    foreach ($items as $item) {
      $updatedDate = DateTimeUtil::formatDate($item->getUpdatedAt());

      $info[] = array(
        $item->getId(),
        '',
        $item->getName(),
        $item->getDescription(),
        $updatedDate,
      );
    }

    return $info;
  }

  public function getDetail($id)
  {
    return $this->getEntityManager()->getRepository(PropertyCategory::class)->find($id);
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