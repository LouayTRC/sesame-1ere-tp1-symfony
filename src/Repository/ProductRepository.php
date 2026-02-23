<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Find products filtered by category id and/or qualite id.
     * Both parameters are optional (null = no filter).
     *
     * @return Product[]
     */
    public function findByFilters(?int $categoryId, ?int $qualiteId): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.Category', 'c')
            ->leftJoin('p.qualite', 'q')
            ->addSelect('c')
            ->addSelect('q')
            ->orderBy('p.id', 'DESC');

        if ($categoryId !== null) {
            $qb->andWhere('c.id = :cat')->setParameter('cat', $categoryId);
        }

        if ($qualiteId !== null) {
            $qb->andWhere('q.id = :qual')->setParameter('qual', $qualiteId);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Count all products
     */
    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Find latest products ordered by id desc
     * @return Product[]
     */
    public function findLatest(int $limit = 5): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
