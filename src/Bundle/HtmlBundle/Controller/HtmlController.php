<?php

namespace App\Bundle\HtmlBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HtmlController extends AbstractController
{
  public function bachmoc(): Response
  {
      $number = random_int(0, 100);

      return $this->render('@Html/bachmoc/home.html.twig', [
          'number' => $number,
      ]);
  }

    public function thanhhuong(): Response
    {
        $number = random_int(0, 100);

        return $this->render('@Html/thanhhuong/home.html.twig', [
          'number' => $number,
        ]);
    }
}