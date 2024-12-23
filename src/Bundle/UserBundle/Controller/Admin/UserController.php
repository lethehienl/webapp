<?php

namespace App\Bundle\UserBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class UserController extends AbstractController
{

    public function login(): Response
    {
        echo 'user/login';die;

      /*  return $this->render('@Html/bachmoc/home.html.twig', [
          'number' => $number,
        ]);*/
    }
}