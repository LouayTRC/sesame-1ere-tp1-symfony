<?php

namespace App\Repository;

use App\Entity\Qualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Qualite>
 */
class QualiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Qualite::class);
    }

    /**
     * Find all qualites ordered by libelle
     * @return Qualite[]
     */
    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.libelle', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
