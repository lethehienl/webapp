<?php

namespace UserBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_role_permission")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\RolePermissionRepository")
 */
class RolePermission extends AbstractEntity
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="permission", type="string", length=255, nullable=true)
   */
  private $permission;

  /**
   * @var string
   *
   * @ORM\Column(name="role_id", type="integer", nullable=true)
   */
  private $role;

  /**
   * Get id.
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getPermission()
  {
    return $this->permission;
  }

  /**
   * @param mixed $permission
   */
  public function setPermission($permission)
  {
    $this->permission = $permission;
  }

  /**
   * @return mixed
   */
  public function getRole()
  {
    return $this->role;
  }

  /**
   * @param mixed $role
   */
  public function setRole($role)
  {
    $this->role = $role;
  }
}
