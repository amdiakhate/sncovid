<?php

namespace App\Repository;

use App\Entity\Comorbidity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Comorbidity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comorbidity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comorbidity[]    findAll()
 * @method Comorbidity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComorbidityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comorbidity::class);
    }

    // /**
    //  * @return Comorbidity[] Returns an array of Comorbidity objects
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
    public function findOneBySomeField($value): ?Comorbidity
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
