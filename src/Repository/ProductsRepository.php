<?php

namespace App\Repository;


use Doctrine\ORM\Query;
use App\Data\SearchData;
use App\Entity\Products;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry$registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Products::class);
        $this->paginator = $paginator;
    }



    /**
     * 
     * Récupérer les produits en lien avec une recherche
     *
     * @return PaginationInterface
     */
    public function findSearch(SearchData $search): PaginationInterface
    {
        // Requête de récupération des produits
        $query = $this
            ->createQueryBuilder('p')
            ->select('c', 'p')
            ->join('p.category', 'c');

    //   dd($search);
            // Si $search n'est pas vide on récupère la query 
        if ($search->getQ() != '') {
            // dd($search);
            $query = $query
                ->andWhere('p.prod_name LIKE :q')
                ->setParameter('q', "%{$search->getQ()}%");
        }


        if (!empty($search->getMin())) {
            $query = $query
                ->andWhere('p.prod_price >= :min')
                ->setParameter('min', $search->getMin());
        }


        if (!empty($search->getMax())) {
            $query = $query
                ->andWhere('p.prod_price <= :max')
                ->setParameter('max', $search->getMax());
        }
        if (!empty($search->promo)) {
            $query = $query
                ->andWhere('p.promo = 1');
                
        }
        if (!empty($search->getCategories())) {
            $query = $query
                ->andWhere('c.cat_id IN (:categories)')
                ->setParameter('categories', $search->getCategories());
                
        }


    $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            8
        );
    }

    // /**
    //  * @return Products[] Returns an array of Products objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
