<?php

namespace AppBundle\Services;

interface NotificationInterface
{
  public function send($payload);
}