<?php

namespace App\Bundle\AgentBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AgentController extends AbstractController
{
  public function test(): Response
  {
      $number = random_int(0, 100);

      return $this->render('@Agent/back_office/agent.html.twig', [
          'number' => $number,
      ]);
  }
}