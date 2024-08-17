<?php

namespace App\Bundle\HomeBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{
  public function index(): Response
  {
      echo 'Home';die;
      $number = random_int(0, 100);

      return $this->render('@Admin/back_office/admin.html.twig', [
          'number' => $number,
      ]);
  }
}