<?php

namespace App\Repository;

use App\Entity\TypeProvider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeProvider|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeProvider|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeProvider[]    findAll()
 * @method TypeProvider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeProviderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeProvider::class);
    }

    // /**
    //  * @return TypeProvider[] Returns an array of TypeProvider objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeProvider
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
