<?php

namespace App\Repository;

use App\Entity\Categoriechambre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Categoriechambre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoriechambre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoriechambre[]    findAll()
 * @method Categoriechambre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriechambreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Categoriechambre::class);
    }

    // /**
    //  * @return Categoriechambre[] Returns an array of Categoriechambre objects
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
    public function findOneBySomeField($value): ?Categoriechambre
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
