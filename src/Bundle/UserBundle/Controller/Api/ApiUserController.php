<?php

namespace App\Bundle\UserBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ApiUserController extends AbstractController
{
  public function login(): Response
  {
      echo 'api/user/login';die;

  }

}