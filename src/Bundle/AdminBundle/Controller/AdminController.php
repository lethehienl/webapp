<?php

namespace App\Bundle\AdminBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminController extends AbstractController
{
  public function test(): Response
  {
      $number = random_int(0, 100);

      return $this->render('@Admin/back_office/admin.html.twig', [
          'number' => $number,
      ]);
  }
}