<?php

namespace PropertyBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_property_amenity")
 * @ORM\Entity(repositoryClass="PropertyBundle\Repository\PropertyAmenityRepository")
 */
class PropertyAmenity extends AbstractEntity
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
   *
   * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Property")
   * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
   */
  private $property;

  /**
   *
   * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Amenity")
   * @ORM\JoinColumn(name="amenity_id", referencedColumnName="id")
   */
  private $amenity;

  /**
   *
   * @ORM\Column(name="is_free", type="integer", nullable=true)
   */
  private $isFree;//1: free, 0: not free

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id): void
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getProperty()
  {
    return $this->property;
  }

  /**
   * @param mixed $property
   */
  public function setProperty($property): void
  {
    $this->property = $property;
  }

  /**
   * @return mixed
   */
  public function getAmenity()
  {
    return $this->amenity;
  }

  /**
   * @param mixed $amenity
   */
  public function setAmenity($amenity): void
  {
    $this->amenity = $amenity;
  }

  /**
   * @return mixed
   */
  public function getIsFree()
  {
    return $this->isFree;
  }

  /**
   * @param mixed $isFree
   */
  public function setIsFree($isFree)
  {
    $this->isFree = $isFree;
  }

  public function getAmenityName() {
    if(!empty($this->amenity)) {
      return $this->amenity->getName();
    }
    return '';
  }

  public function getAmenityIconName() {
    if(!empty($this->amenity)) {
      return $this->amenity->getIconName();
    }
    return '';
  }

  public function getAmenityIconKey() {
    if(!empty($this->amenity)) {
      return $this->amenity->getIconKey();
    }
    return '';
  }

}
