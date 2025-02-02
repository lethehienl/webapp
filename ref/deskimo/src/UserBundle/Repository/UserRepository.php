<?php

namespace UserBundle\Repository;

use AppBundle\Utils\PagingUtil;
use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\Company;
use UserBundle\Utils\RolesUtil;

class UserRepository extends EntityRepository
{
  public function getUserList($users)
  {
    $qb = $this->createQueryBuilder('u');

    $qb->where('u.id IN (:users)');
    $qb->setParameter('users', $users);

    return $qb->getQuery()->execute();
  }

  public function getTotalUsers($keyword)
  {
    $queryBuilder = $this->createQueryBuilder('user');
    $queryBuilder->select('COUNT(user.id) AS total_users');
    $queryBuilder->join('user.userProfile', 'user_profile');

    if (!empty($keyword)) {
      $keyword = '%' . $keyword . '%';
      $queryBuilder->andWhere('user.username LIKE :keyword OR user.fullName LIKE :keyword OR user_profile.phoneNumber LIKE :keyword');
      $queryBuilder->setParameter('keyword', $keyword);
    }

    return (int)$queryBuilder->getQuery()->getSingleScalarResult();
  }

  public function getUsers($keyword, $status, $offset = 0, $itemPerPage = PagingUtil::DEFAULT_ITEM_PER_PAGE)
  {
    $queryBuilder = $this->createQueryBuilder('user');
    $queryBuilder->select('user');
    $queryBuilder->join('user.userProfile', 'user_profile');

    if (!empty($keyword)) {
      $keyword = '%' . $keyword . '%';
      $queryBuilder->andWhere('user.username LIKE :keyword OR user.fullName LIKE :keyword OR user_profile.phoneNumber LIKE :keyword');
      $queryBuilder->setParameter('keyword', $keyword);
    }

    $queryBuilder->orderBy('user.id', 'DESC');
    $queryBuilder->setFirstResult($offset);
    $queryBuilder->setMaxResults($itemPerPage);

    return $queryBuilder->getQuery()->execute();
  }
}
