<?php

namespace App\Repository;

use App\Entity\Detailsoffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Detailsoffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailsoffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailsoffre[]    findAll()
 * @method Detailsoffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsoffreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Detailsoffre::class);
    }

    // /**
    //  * @return Detailsoffre[] Returns an array of Detailsoffre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Detailsoffre
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
