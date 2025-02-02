<?php

namespace VisitBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tbl_visit_evaluation")
 * @ORM\Entity(repositoryClass="VisitBundle\Repository\VisitEvaluationRepository")
 */
class VisitEvaluation extends AbstractEntity
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
   * @ORM\Column(name="star", type="integer", nullable=true)
   */
  private $star;

  /**
   * @var string
   *
   * @ORM\Column(name="message", type="string", length=512, nullable=true)
   */
  private $message;

  /**
   *
   * @ORM\ManyToOne(targetEntity="VisitBundle\Entity\Visit")
   * @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
   */
  private $visit;

  /**
   *
   * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Property")
   * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
   */
  private $property;

  /**
   *
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(name="reviewer_id", referencedColumnName="id")
   */
  private $reviewer;

  /**
   *
   * @ORM\Column(name="status", type="integer", nullable=true)
   */
  private $status = 0;  //0: waiting for review, 1: reviewed,  2: Good to show, 3: Bad to hide

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

  public function getStar()
  {
    return $this->star;
  }

  public function setStar($star): void
  {
    $this->star = $star;
  }

  public function getMessage()
  {
    return $this->message;
  }

  /**
   * @param string $message
   */
  public function setMessage($message)
  {
    $this->message = $message;
  }

  /**
   * @return mixed
   */
  public function getVisit()
  {
    return $this->visit;
  }

  /**
   * @param mixed $visit
   */
  public function setVisit($visit): void
  {
    $this->visit = $visit;
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
  public function getReviewer()
  {
    return $this->reviewer;
  }

  /**
   * @param mixed $reviewer
   */
  public function setReviewer($reviewer): void
  {
    $this->reviewer = $reviewer;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus(int $status): void
  {
    $this->status = $status;
  }
}
