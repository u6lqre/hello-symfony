<?php

namespace App\Controller;

use App\Repository\PageAccessRepository;
use DateTime;
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
      $formattedDate = $this->formatDate($lastAccess);
    } catch (Exception $e) {
      $formattedDate = null;
    }

    $repository->createNewAccess($entityManager);

    return $this->render("greetings/show.html.twig", [
      "formattedDate" => $formattedDate
    ]);
  }

  private function formatDate($lastAccess)
  {
    $dateTime = new DateTime($lastAccess);

    $months = [
      "01" => "enero",
      "02" => "febrero",
      "03" => "marzo",
      "04" => "abril",
      "05" => "mayo",
      "06" => "junio",
      "07" => "julio",
      "08" => "agosto",
      "09" => "septiembre",
      "10" => "octubre",
      "11" => "noviembre",
      "12" => "diciembre"
    ];

    return [
      'year' => $dateTime->format('Y'),
      'month' => $months[$dateTime->format('m')],
      'day' => $dateTime->format('d'),
      'hour' => $dateTime->format('H:i:s')
    ];
  }
}
