<?php

namespace UserBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("tbl_device_token")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\DeviceTokenRepository")
 */
class DeviceToken extends AbstractEntity
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  protected $user;

  /**
   * @var string
   *
   * @ORM\Column(name="device_token", type="string", length=512, nullable=true)
   */
  private $deviceToken;

  /**
   *
   * @ORM\Column(name="from_os", type="integer", nullable=true)
   */
  private $fromOs;//1: Android, 2: iOS

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id): void
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getUser()
  {
    return $this->user;
  }

  /**
   * @param mixed $user
   */
  public function setUser($user): void
  {
    $this->user = $user;
  }

  /**
   * @return string
   */
  public function getDeviceToken(): string
  {
    return $this->deviceToken;
  }

  /**
   * @param string $deviceToken
   */
  public function setDeviceToken(string $deviceToken): void
  {
    $this->deviceToken = $deviceToken;
  }

  public function getFromOs()
  {
    return $this->fromOs;
  }

  public function setFromOs($fromOs): void
  {
    $this->fromOs = $fromOs;
  }
}
