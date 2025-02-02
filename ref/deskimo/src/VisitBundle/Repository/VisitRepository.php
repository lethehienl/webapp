<?php

namespace VisitBundle\Repository;

use AppBundle\Utils\DateTimeUtil;
use CompanyBundle\Utils\PropertyCompanyUtil;
use Doctrine\ORM\EntityRepository;
use VisitBundle\Utils\VisitUtil;

class VisitRepository extends EntityRepository
{
  public function getVisits($lastId, $itemPerPage = 5)
  {
    $queryBuilder = $this->createQueryBuilder('visit');
    $queryBuilder->select('visit');

    if (!empty($lastId)) {
      $queryBuilder->where('visit.id < :last_id');
      $queryBuilder->setParameter('last_id', $lastId);
    }

    $queryBuilder->orderBy('visit.id', 'DESC');
    $queryBuilder->setMaxResults($itemPerPage);

    return $queryBuilder->getQuery()->execute();
  }

  public function getRevenue($company, $property)
  {
    $currentDate = new \DateTime();
    $lastDate = DateTimeUtil::getDateAgoFromNow(new \DateTime());

    $em = $this->getEntityManager();
    $query = 'SELECT SUM(visit.total_time) AS total_time, DATE(visit.updated_at) AS updated_date, SUM(visit.total_price) AS total, COUNT(visit.user_id) AS total_user
      FROM tbl_visit visit LEFT JOIN tbl_property property ON visit.property_id = property.id WHERE 1=1';

    if ($company != PropertyCompanyUtil::ALL_COMPANIES_VALUE) {
      if ($property != PropertyCompanyUtil::ALL_PROPERTIES_VALUE) {
        $query .= ' AND visit.property_id = ' . $property->getId();
      } else {
        $query .= ' AND property.company_id = ' . $company->getId();
      }
    }

    $query .= ' AND visit.updated_at BETWEEN :from_date AND :to_date GROUP BY DATE(visit.updated_at)';
    $statement = $em->getConnection()->prepare($query);

    $fromDate = $lastDate->format('Y-m-d H:i:s');
    $toDate = $currentDate->format('Y-m-d H:i:s');

    $statement->bindParam('from_date', $fromDate);
    $statement->bindParam('to_date', $toDate);
    $statement->execute();

    return $statement->fetchAll();
  }
}
