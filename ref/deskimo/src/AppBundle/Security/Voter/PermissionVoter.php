<?php

namespace AppBundle\Security\Voter;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\RolePermission;
use UserBundle\Entity\User;
use UserBundle\Utils\PermissionUtil;

class PermissionVoter extends Voter
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  protected function supports($attribute, $subject)
  {
    return isset(PermissionUtil::PERMISSION_MAP[$attribute]);
  }

  protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
  {
    /**
     * @var User $user
     */
    $user = $token->getUser();
    // if the user is anonymous, do not grant access
    if (!$user instanceof UserInterface) {
      return false;
    }

    $roleId = $user->getRoleId();
    $rolePermissionRepo = $this->entityManager->getRepository(RolePermission::class);
    $permission = $rolePermissionRepo->findOneBy(['role' => $roleId, 'permission' => $attribute]);

    return !empty($permission);
  }
}
