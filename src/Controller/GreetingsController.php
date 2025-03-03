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
  public function show(PageAccessRepository $repository, EntityManagerInterface $entity_manager): Response
  {
    try {
      $last_access = $repository->getLastAccess();
    } catch (Exception $e) {
      $last_access = null;
    }

    $repository->createNewAccess($entity_manager);

    return $this->render("greetings/show.html.twig", [
      "last_access" => $last_access
    ]);
  }
}
