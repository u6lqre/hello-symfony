<?php

namespace App\Controller;

use App\Repository\PageAccessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GreetingsController extends AbstractController
{
  #[Route('/helloworld')]
  public function show(PageAccessRepository $repository): Response
  {
    $last_visit = $repository->getLastAccess();

    return $this->render("greetings/show.html.twig", [
      "last_visit" => $last_visit
    ]);
  }
}
