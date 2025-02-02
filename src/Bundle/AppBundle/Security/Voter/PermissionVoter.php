<?php

namespace App\Bundle\AppBundle\Security\Voter;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Bundle\UserBundle\Entity\RolePermission;
use App\Bundle\UserBundle\Entity\User;
use App\Bundle\UserBundle\Utils\PermissionUtil;

class PermissionVoter extends Voter
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

    public const EDIT = 'edit';
    public const VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::VIEW], true);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::EDIT:
                return $user->hasRole('ROLE_ADMIN'); // Just admin can edit
            case self::VIEW:
                return $user->hasRole('ROLE_USER'); // user can view
        }

        return false;
    }

  /*protected function supports($attribute, $subject)
  {
    return isset(PermissionUtil::PERMISSION_MAP[$attribute]);
  }

  protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
  {

    $user = $token->getUser();
    // if the user is anonymous, do not grant access
    if (!$user instanceof UserInterface) {
      return false;
    }

    $roleId = $user->getRoleId();
    $rolePermissionRepo = $this->entityManager->getRepository(RolePermission::class);
    $permission = $rolePermissionRepo->findOneBy(['role' => $roleId, 'permission' => $attribute]);

    return !empty($permission);
  }*/
}
