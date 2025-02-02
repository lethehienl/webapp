<?php

namespace PropertyBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_property_staff")
 * @ORM\Entity(repositoryClass="PropertyBundle\Repository\PropertyStaffRepository")
 */
class PropertyStaff extends AbstractEntity
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
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
   */
  private $staff;

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
  public function getStaff()
  {
    return $this->staff;
  }

  /**
   * @param mixed $staff
   */
  public function setStaff($staff): void
  {
    $this->staff = $staff;
  }
}
