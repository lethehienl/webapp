<?php

namespace App\Bundle\AdminBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminController extends AbstractController
{
  public function admin(): Response
  {
      $number = random_int(0, 100);

      return $this->render('@Admin/back_office/admin.html.twig', [
          'number' => $number,
      ]);
  }

    public function coreui(): Response
    {
        $number = random_int(0, 100);

        return $this->render('@Admin/back_office/coreui.html.twig', [
          'number' => $number,
        ]);
    }
}