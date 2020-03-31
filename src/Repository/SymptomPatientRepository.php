<?php

namespace App\Repository;

use App\Entity\SymptomPatient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SymptomPatient|null find($id, $lockMode = null, $lockVersion = null)
 * @method SymptomPatient|null findOneBy(array $criteria, array $orderBy = null)
 * @method SymptomPatient[]    findAll()
 * @method SymptomPatient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SymptomPatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SymptomPatient::class);
    }

    // /**
    //  * @return SymptomPatient[] Returns an array of SymptomPatient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SymptomPatient
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
