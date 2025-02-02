<?php

namespace PropertyBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AmenityRepository extends EntityRepository
{
  public function getDatatale($keyword, $itemPerPage, $offset)
  {
    if (!empty($keyword)) {
      $keyword = '%' . $keyword . '%';
    }

    $queryBuilder = $this->createQueryBuilder('table');
    $queryBuilder->select('table')->where('1 = 1');


    if (!empty($keyword)) {
      $queryBuilder->andWhere('table.name LIKE :keyword');
      $queryBuilder->setParameter('keyword', $keyword);
    }

    $queryBuilder->orderBy('table.updatedAt', 'DESC');
    $queryBuilder->setFirstResult($offset);
    $queryBuilder->setMaxResults($itemPerPage);

    return $queryBuilder->getQuery()->getResult();
  }

  public function getTotalDatatale($keyword)
  {
    if (!empty($keyword)) {
      $keyword = '%' . $keyword . '%';
    }

    $queryBuilder = $this->createQueryBuilder('table');
    $queryBuilder->select('COUNT(table.id)')->where('1 = 1');


    if (!empty($keyword)) {
      $queryBuilder->andWhere('table.name LIKE :keyword');
      $queryBuilder->setParameter('keyword', $keyword);
    }

    return $queryBuilder->getQuery()->getSingleScalarResult();
  }
}
