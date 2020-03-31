<?php

namespace App\Repository;

use App\Entity\ComorbidityPatient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ComorbidityPatient|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComorbidityPatient|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComorbidityPatient[]    findAll()
 * @method ComorbidityPatient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComorbidityPatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComorbidityPatient::class);
    }

    // /**
    //  * @return ComorbidityPatient[] Returns an array of ComorbidityPatient objects
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
    public function findOneBySomeField($value): ?ComorbidityPatient
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
