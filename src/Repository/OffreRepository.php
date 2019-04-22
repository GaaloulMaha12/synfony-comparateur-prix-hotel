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
//        $debut = \DateTime::createFromFormat('d/m/Y', '01/01/2019');
//        $datefin = \DateTime::createFromFormat('d/m/Y', '01/04/2019');

//        var_dump($debut <= $fin);
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
//            var_dump($datefin);
        if ($debut != null && $datefin != null) {
            var_dump(strtotime($debut));
            var_dump($datefin);

//            $debut = strtotime($debut);
//            $datefin = strtotime($datefin);

            $q->setParameter('debut', $debut)
                ->setParameter('datefin', $datefin)

                ->andWhere('o.datefin >= :debut OR o.datedebut <= :debut OR o.datefin >= :datefin OR o.datedebut <= :datefin ');

        } else if ($datefin != null) {
            $q->setParameter('datefin', $datefin)
                ->andWhere('o.datefin >= :datefin AND o.datedebut <= :datefin ');
        } else if ($debut != null) {
            var_dump($debut);
            $q->setParameter('debut', $debut)
                ->andWhere('o.datefin >= :debut AND o.datedebut <= :debut ');
        }
        if ($note != null) {
            $q->setParameter('note', $note)
                ->andWhere('h.note = :note');
        }
//        if ($chambre != null) {
//            $q->setParameter('cham', $chambre)
//                ->andWhere('c.typechambre = :cham');
//        }
        if ($autre != null) {
            $q->setParameter('autre', '%' . $autre . '%')
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
