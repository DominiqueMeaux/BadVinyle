<?php

namespace App\Repository;

use App\Entity\CoefPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoefPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoefPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoefPrice[]    findAll()
 * @method CoefPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoefPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoefPrice::class);
    }

    // /**
    //  * @return CoefPrice[] Returns an array of CoefPrice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoefPrice
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
