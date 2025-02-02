<?php

namespace CompanyBundle\Repository;

use AppBundle\Utils\StatusUtil;
use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\User;

class PropertyCompanyRepository extends EntityRepository
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

  public function getCompaniesByUser(User $user) {
    $queryBuilder = $this->createQueryBuilder('property_company');
    $queryBuilder->join('property_company.properties', 'properties');
    $queryBuilder->join('property_company.propertyCompanyUsers', 'property_company_users');

    $queryBuilder->select('property_company')->where('1 = 1');
    $queryBuilder->andWhere('property_company.status = :status');
    $queryBuilder->setParameter('status', StatusUtil::ACTIVE_CODE);

    $queryBuilder->andWhere('property_company_users.user = :user');
    $queryBuilder->setParameter('user', $user);
    return $queryBuilder->getQuery()->getResult();
  }
}
