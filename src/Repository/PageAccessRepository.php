<?php

namespace App\Repository;

use App\Entity\PageAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PageAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageAccess::class);
    }

    public function getLastAccess(): ?PageAccess
    {
        return $this->createQueryBuilder('a')
            ->select('a.last_access')
            ->orderBy('a.last_access', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function createNewAccess(EntityManagerInterface $entity_manager)
    {
        $page_access = new PageAccess();

        $current_date = new \DateTime();
        $page_access->setLastAccess($current_date);

        $entity_manager->persist($page_access);
        $entity_manager->flush();
    }
}
