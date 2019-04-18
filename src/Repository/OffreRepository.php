<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    // /**
    //  * @return Offre[] Returns an array of Offre objects
    //  */
    /*
    */
    public function getHotelsByCriteria($pos, $type, $debut, $datefin, $note, $chambre, $autre)
    {
        $debut = \DateTime::createFromFormat('d/m/Y', $debut);
        $datefin = \DateTime::createFromFormat('d/m/Y', $datefin);

        $q = $this->createQueryBuilder('o')
            ->addSelect('h')
            ->leftJoin('o.hotel', 'h')
            ->addSelect('c')
            ->leftJoin('o.chambre', 'c');
        if ($pos != null) {
            $q->setParameter('pos', $pos)
                ->andWhere('h.positionhotel = :pos');
        }
        if ($type != null) {
            $q->setParameter('type', $type)
                ->andWhere('h.typehotel = :type');
        }
        if ($debut != null) {
            var_dump($debut);

            $q->setParameter('debut', $debut)
                ->andWhere('o.datedebut < :debut');
        }
        if ($datefin != null) {
            var_dump($datefin);
            $q->setParameter('datefin', $datefin)
                ->andWhere('o.datefin > :datefin');
        }
        if ($note != null) {
            $q->setParameter('note', $note)
                ->andWhere('h.note = :note');
        }
        if ($chambre != null) {
            $q->setParameter('cham', $chambre)
                ->andWhere('c.typechambre = :cham');
        }
        if ($autre != null) {
            $q->setParameter('autre', '%'.$autre.'%')
                ->andWhere('h.service LIKE :autre');
        }
        return $q
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Offre
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
