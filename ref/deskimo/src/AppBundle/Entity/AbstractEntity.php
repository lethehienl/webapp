<?php
/**
 * Created by PhpStorm.
 * User: triqm
 * Date: 12/17/19
 * Time: 2:00 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 *
 * @MappedSuperclass
 */
abstract class AbstractEntity
{
  /**
   * @ORM\Column(name="created_at", type="datetime")
   */
  private $createdAt;

  /**
   * @ORM\Column(name="updated_at", type="datetime")
   */
  private $updatedAt;

  public function __construct()
  {
    $currentDate = new \DateTime();
    $this->createdAt = $currentDate;
    $this->updatedAt = $currentDate;
  }

  public function getCreatedAt()
  {
    return $this->createdAt;
  }


  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }


  public function setUpdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;
    return $this;
  }

  /**
   * @ORM\PreUpdate
   */
  public function setUpdatedAtValue(PreUpdateEventArgs $args)
  {
    $changes = $args->getEntityChangeSet();
    if (empty($changes['updatedAt'])) {
      $this->setUpdatedAt(new \DateTime());
    }
  }
}
