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
    public function getHotelsByCriteria($pos, $type, $debut, $datefin, $autre, $chambre, $avis, $budget)
    {
        $q = $this->createQueryBuilder('o')
            ->addSelect('h')
            ->leftJoin('o.hotel', 'h')
            ->addSelect('d')
            ->leftJoin('o.detailsoffres', 'd')
            ->addSelect('c')
            ->leftJoin('d.chambre', 'c');
        if ($pos != null  && $pos != "Destination") {
            $q->setParameter('pos', $pos)
                ->andWhere('h.positionhotel = :pos');
        }
        if ($type != null  && $type != "type hotel") {
            $q->setParameter('type', $type)
                ->andWhere('h.typehotel = :type');
        }
        if ($debut != null && $datefin != null) {
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

        if ($chambre != null  && $chambre != "Type chambre") {
            $q->setParameter('cham', $chambre)
                ->andWhere('c.typechambre = :cham');
        }
        if ($avis != null  && $avis != "Avis") {
            $q->setParameter('avis', $avis)
                ->andWhere('h.note = :avis');
        }
        if ($autre != null  && $autre != "Service Spécifique") {
            $q->setParameter('autre', $autre)
                ->andWhere('h.service LIKE :autre');
        }
        if ($budget != null && $budget != "Budget") {
            var_dump($budget);
            // split/
//            $budget = "50-101";
            $budgetArray = explode("-", $budget);
            $min = $budgetArray[0];
            $max = $budgetArray[1];

            var_dump($budgetArray);
            $q
                ->setParameter('min', (int)$min)
                ->setParameter('max', (int)$max)
                ->andWhere('d.tarif >= :min')
                ->andWhere(' d.tarif <= :max ');
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
