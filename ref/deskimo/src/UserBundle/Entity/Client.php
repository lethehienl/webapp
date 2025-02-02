<?php

namespace UserBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("tbl_oauth2_clients")
 * @ORM\Entity
 */
class Client extends BaseClient
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

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
    parent::__construct();
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
}
