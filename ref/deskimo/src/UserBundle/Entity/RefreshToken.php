<?php

namespace UserBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("tbl_oauth2_refresh_tokens")
 * @ORM\Entity
 */
class RefreshToken extends BaseRefreshToken
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="Client")
   * @ORM\JoinColumn(nullable=false)
   */
  protected $client;

  /**
   * @ORM\ManyToOne(targetEntity="User")
   */
  protected $user;

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
}
