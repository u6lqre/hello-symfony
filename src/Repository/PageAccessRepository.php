<?php

namespace App\Repository;

use App\Entity\PageAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
            ->orderBy('a.last_access', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
