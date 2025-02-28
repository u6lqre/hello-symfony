<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GreetingsController extends AbstractController
{
  #[Route('/helloworld')]
  public function show(): Response
  {
    return $this->render("greetings/show.html.twig");
  }
}
