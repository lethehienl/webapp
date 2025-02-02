<?php

namespace App\Bundle\AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AppController extends AbstractController
{
  public function test(): Response
  {
        echo '<pre>'; print_r('AppController');die;
      $number = random_int(0, 100);

      return $this->render('@App/back_office/admin.html.twig', [
          'number' => $number,
      ]);
  }
}