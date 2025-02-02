<?php

namespace PropertyBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_amenity")
 * @ORM\Entity(repositoryClass="PropertyBundle\Repository\AmenityRepository")
 */
class Amenity extends AbstractEntity
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
   * @ORM\Column(name="code", type="string", length=128, unique=true)
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="icon_name", type="string", length=256, nullable=true)
   */
  private $iconName;

  /**
   * @var string
   *
   * @ORM\Column(name="icon_key", type="string", length=256, nullable=true)
   */
  private $iconKey;

  /**
   * @var
   *
   * @ORM\OneToMany(targetEntity="PropertyBundle\Entity\PropertyAmenity", mappedBy="benefit")
   */
  private $property;

  public function __construct()
  {
    parent::__construct();
    $this->property = new ArrayCollection();
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName( $name)
  {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getIconName()
  {
    return $this->iconName;
  }

  /**
   * @param string $iconName
   */
  public function setIconName( $iconName)
  {
    $this->iconName = $iconName;
  }

  /**
   * @return string
   */
  public function getIconKey()
  {
    return $this->iconKey;
  }

  /**
   * @param string $iconKey
   */
  public function setIconKey( $iconKey)
  {
    $this->iconKey = $iconKey;
  }


}
