<?php

namespace App\Controller;

use App\Repository\PageAccessRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GreetingsController extends AbstractController
{
  #[Route('/helloworld')]
  public function show(PageAccessRepository $repository, EntityManagerInterface $entityManager): Response
  {
    try {
      $lastAccess = $repository->getLastAccess();
    } catch (Exception $e) {
      $lastAccess = null;
    }

    $repository->createNewAccess($entityManager);

    return $this->render("greetings/show.html.twig", [
      "lastAccess" => $lastAccess
    ]);
  }
}
