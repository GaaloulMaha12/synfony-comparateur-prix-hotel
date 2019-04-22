<?php

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Hotel::class);
    }

     /**
      * @return Hotel[] Returns an array of Hotel objects
      */

    public function findHotelsByCiteria($dest)
    {
        return $this->createQueryBuilder('h')
            ->addSelect('o')
            ->leftJoin('h.offre','o')
            ->andWhere('h.id = o.hotel_id')
            ->andWhere('h.positionhotel = :dest')
            ->setParameter('dest', $dest)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Hotel
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getHotelsByCriteria($pos, $debut, $datefin)
    {
        // TODO: Implement getHotelsByCriteria() method.
    }
}
