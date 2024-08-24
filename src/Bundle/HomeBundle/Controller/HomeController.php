<?php

namespace App\Bundle\HomeBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{
  public function index(): Response
  {
      $number = random_int(0, 100);

      return $this->render('@Html/thanhhuong/home.html.twig', [
        'number' => $number,
      ]);
  }
}