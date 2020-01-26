<?php

namespace App\Repository;

use App\Entity\HomeText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HomeText|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeText|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeText[]    findAll()
 * @method HomeText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeText::class);
    }

    // /**
    //  * @return HomeText[] Returns an array of HomeText objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomeText
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
