<?php

namespace App\Bundle\AppBundle\Security\Provider;

use App\Bundle\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\Bundle\UserBundle\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
class UserProvider implements UserProviderInterface
{
    protected $class;

    protected $userRepository;

    public function __construct(EntityManager $entityManager, $class = User::class)
    {
        $this->class = $class;
        $this->userRepository = $entityManager->getRepository($class);
    }


    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->loadUserByIdentifier($identifier);

        if (!$user) {
            throw new UserNotFoundException("User not found");
        }

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }

}