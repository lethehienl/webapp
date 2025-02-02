<?php

namespace UserBundle\Controller;

use AppBundle\Controller\NaviController;
use UserBundle\Entity\User;

abstract class AnonymousController extends NaviController
{
  public function userRepository()
  {
    $entityManager = $this->getDoctrine()->getManager();
    /** @var \UserBundle\Repository\UserRepository $userRepo */
    $userRepo = $entityManager->getRepository(User::class);

    return $userRepo;
  }

  protected function checkTimeValid($timeCheck)
  {
    $now = new \DateTime();
    $nowToStr = $now->getTimestamp();
    $timeToStr = $timeCheck->getTimestamp();

    if (!$timeCheck) {
      return false;
    }

    if ($nowToStr < $timeToStr) {
      return true;
    }

    return false;
  }
}