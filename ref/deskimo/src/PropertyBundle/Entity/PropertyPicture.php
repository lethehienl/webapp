<?php

namespace PropertyBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_property_picture")
 * @ORM\Entity(repositoryClass="PropertyBundle\Repository\PropertyPictureRepository")
 */
class PropertyPicture extends AbstractEntity
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
   * @ORM\Column(name="file_key", type="string", length=256, nullable=true)
   */
  private $fileKey;

  /**
   *
   * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Property", inversedBy="pictures", cascade="persist")
   * @ORM\JoinColumn(name="property_id", referencedColumnName="id", onDelete="SET NULL")
   */
  private $property;

  /**
   *
   * @ORM\Column(name="weight", type="integer", nullable=true)
   */
  private $weight;

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

  public function getFileKey()
  {
    return $this->fileKey;
  }

  /**
   * @param string $fileKey
   */
  public function setFileKey($fileKey): void
  {
    $this->fileKey = $fileKey;
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
  public function getWeight()
  {
    return $this->weight;
  }

  /**
   * @param mixed $weight
   */
  public function setWeight($weight)
  {
    $this->weight = $weight;
  }
}
