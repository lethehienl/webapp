<?php

namespace PropertyBundle\Repository;

use AppBundle\Utils\StatusUtil;
use CompanyBundle\Entity\PropertyCompany;
use Doctrine\ORM\EntityRepository;

class PropertyRepository extends EntityRepository
{
  public function getDatatale($keyword, $offset = 0, $itemPerPage = 10)
  {
    $queryBuilder = $this->createQueryBuilder('table');
    $queryBuilder->select('table')->where('1 = 1');

    if (!empty($status)) {
      $queryBuilder->andWhere('table.status = :status');
      $queryBuilder->setParameter('status', $status);
    }

    if (!empty($keyword)) {
      $keyword = '%' . $keyword . '%';
      $queryBuilder->andWhere('table.name LIKE :keyword');
      $queryBuilder->setParameter('keyword', $keyword);
    }

    $queryBuilder->orderBy('table.updatedAt', 'DESC');
    $queryBuilder->setFirstResult($offset);
    $queryBuilder->setMaxResults($itemPerPage);

    return $queryBuilder->getQuery()->execute();
  }

  public function getTotalDatatale($keyword)
  {
    $queryBuilder = $this->createQueryBuilder('table');
    $queryBuilder->select('COUNT(table.id)')->where('1 = 1');

    if (!empty($status)) {
      $queryBuilder->andWhere('table.status = :status');
      $queryBuilder->setParameter('status', $status);
    }

    if (!empty($keyword)) {
      $keyword = '%' . $keyword . '%';
      $queryBuilder->andWhere('table.name LIKE :keyword');
      $queryBuilder->setParameter('keyword', $keyword);
    }

    return $queryBuilder->getQuery()->getSingleScalarResult();
  }

  public function searchProperties($criteria, $itemPerPage = 6)
  {
    $queryBuilder = $this->createQueryBuilder('property');
    $queryBuilder->select('property');
    $queryBuilder->where('1=1');

    if (!empty($criteria['country_code'])) {
      $queryBuilder->andWhere('property.countryCode = :country_code');
      $queryBuilder->setParameter('country_code', $criteria['country_code']);
    }

    if (!empty($criteria['is_open'])) {
      $queryBuilder->andWhere('property.isOpen = :is_open');
      $queryBuilder->setParameter('is_open', $criteria['is_open']);
    }

    if (!empty($criteria['keyword'])) {
      $keyword = '%' . $criteria['keyword'] . '%';
      $queryBuilder->andWhere('property.name LIKE :keyword');
      $queryBuilder->setParameter('keyword', $keyword);
    }

    if (!empty($criteria['type'])) {
      $queryBuilder->andWhere('property.name = :type');
      $queryBuilder->setParameter('type', $criteria['type']);
    }

    //sort
    if (!empty($criteria['sort_by'])) {
      switch($criteria['sort_by']) {
        case 1:
          $queryBuilder->orderBy('property.id', 'DESC');
          break;

        case 2:
          $queryBuilder->orderBy('property.ratePerHour', 'ASC');
          break;

        case 3:
          $queryBuilder->orderBy('property.ratePerHour', 'DESC');
          break;
      }
    } else {
      $queryBuilder->orderBy('property.id', 'DESC');
    }

    $offset = 0;

    if (!empty($criteria['page'])) {
      $offset = $criteria['page'] - 1 * $itemPerPage;
    }

    $queryBuilder->setFirstResult($offset);
    $queryBuilder->setMaxResults($itemPerPage);

    return $queryBuilder->getQuery()->execute();
  }

  public function getPropertiesByCompany(PropertyCompany $company) {
    $queryBuilder = $this->createQueryBuilder('property');
    $queryBuilder->join('property.company', 'company');

    $queryBuilder->select('property')->where('1 = 1');
    $queryBuilder->andWhere('company.id = :company');
    $queryBuilder->setParameter('company', $company->getId());
    return $queryBuilder->getQuery()->getResult();
  }
}
