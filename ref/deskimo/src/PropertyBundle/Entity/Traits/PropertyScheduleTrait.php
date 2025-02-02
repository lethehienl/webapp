<?php
namespace PropertyBundle\Entity\Traits;
trait PropertyScheduleTrait {

  /**
   *
   * @ORM\Column(name="schedule", type="text", nullable=true)
   */
  private $schedule;

  /**
   * @return mixed
   */
  public function getSchedule()
  {
    return $this->schedule;
  }

  /**
   * @param mixed $schedule
   */
  public function setSchedule($schedule): void
  {
    $this->schedule = $schedule;
  }

}