<?php

namespace App\Repository;

use App\Entity\Victime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Victime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Victime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Victime[]    findAll()
 * @method Victime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VictimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Victime::class);
    }

    // /**
    //  * @return Victime[] Returns an array of Victime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Victime
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
