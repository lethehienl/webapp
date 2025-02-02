<?php
namespace App\Bundle\UserBundle\Repository;
use App\Bundle\UserBundle\Entity\User;
//use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository  implements UserLoaderInterface
{
    public function loadUserByIdentifier(string $usernameOrEmail): ?User
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
          'SELECT u
                FROM App\Bundle\UserBundle\Entity\User u
                WHERE u.username = :query
                OR u.email = :query'
        )
          ->setParameter('query', $usernameOrEmail)
          ->getOneOrNullResult();
    }
    public function findOneByEmail(string $email): ?User
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
          'SELECT u
                FROM App\Bundle\UserBundle\Entity\User u
                WHERE u.email = :query'
        )
          ->setParameter('query', $email)
          ->getOneOrNullResult();
    }
}