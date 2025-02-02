<?php

namespace App\Bundle\UserBundle\Services;

use App\Bundle\AppBundle\Services\AbstractService;
use App\Bundle\AppBundle\Utils\DateTimeUtil;
use App\Bundle\AppBundle\Utils\FileUtil;
use App\Bundle\AppBundle\Utils\SecurityUtil;
use App\Bundle\AppBundle\Utils\ServiceUtil;
use App\Bundle\AppBundle\Utils\StatusUtil;
use App\Bundle\AppBundle\Utils\StringUtil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use App\Bundle\UserBundle\Entity\RolePermission;
use App\Bundle\UserBundle\Entity\User;
use App\Bundle\UserBundle\Repository\UserRepository;
use App\Bundle\UserBundle\Utils\GroupUtil;
use App\Bundle\UserBundle\Utils\PermissionUtil;
use App\Bundle\UserBundle\Utils\RolesUtil;
use App\Bundle\UserBundle\Utils\UserUtil;
use Cocur\Slugify\Slugify;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserService
{
    private $entityManager;

    /**
     * AppService constructor.
     */
    public function __construct(
      EntityManagerInterface $entityManager,
    ) {
        $this->entityManager = $entityManager;
    }

    public function getRepository($objClass)
    {
        return $this->entityManager->getRepository($objClass);
    }

    public function findUserById($id)
    {
        return $this->getRepository(User::class)->find($id);
    }

    public function findUserBy($params)
    {
        return $this->getRepository(User::class)->findOneBy($params);
    }
}
